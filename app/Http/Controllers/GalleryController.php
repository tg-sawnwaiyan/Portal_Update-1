<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use DB;
use File;

class GalleryController extends Controller
{
    public function index()
    {
       
    }
    
    public function getPhotobyCustomerId($customer_id) {
        $photo_list = DB::select("SELECT g.id,g.title,g.photo,g.description, (CASE c.type_id WHEN '2' THEN CONCAT('/upload/hospital_profile/',g.photo) ELSE CONCAT('/upload/nursing_profile/',g.photo) END) as src 
        FROM galleries as g INNER JOIN customers as c ON g.profile_id = c.id WHERE g.type='photo' AND g.profile_id = ".$customer_id);
        return $photo_list;
    }

    public function getVideobyCustomerId($customer_id) {
        $video_list = Gallery::where("profile_id",$customer_id)
                            ->where('type','=', 'video')->select('id','title','photo','description')
                            ->get()
                            ->toArray();
        return $video_list;
    }

    public function getPanoramabyCustomerId($customer_id) {
        $sql = "SELECT id,photo,title,description,type,'' as path, '' as file FROM galleries WHERE type='panorama' and profile_id=$customer_id";
        $panorama_list = DB::select($sql);
        return $panorama_list;
    }

    public function deleteGallery(Request $request) {
        $request = $request->all();
        if($request['custype'] == 'nursing') {
            if($request['type'] == 'photo') {
                $file = 'upload/nursing_profile/'.$request['photo'];
            } 
            if($request['type'] == 'panorama') {
                $file = 'upload/nursing_profile/Imagepanorama/'.$request['photo'];
            } 
        }
        else{
            $file = 'upload/hospital_profile/'.$request['photo'];
        }
        
        File::delete($file);
        Gallery::where(['id'=> $request['id']])->delete(); 
    }

}