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
<<<<<<< HEAD
        $photo_list = Gallery::select('id','photo','title','description','type')->where("customer_id",$customer_id)
                             ->where('type','=', 'photo')
                             ->get()
                             ->toArray();
=======
        $photo_list = Gallery::where("customer_id",$customer_id)
                            ->where('type','=', 'photo')->select('id','title','photo','description')
                            ->get()
                            ->toArray();
>>>>>>> fcbae13c698ccae7bcb93f61d60745fef095413c
        return $photo_list;
    }

    public function getVideobyCustomerId($customer_id) {
<<<<<<< HEAD
        $video_list = Gallery::select('id','photo','title','description','type')->where("customer_id",$customer_id)
                             ->where('type','=', 'video')
                             ->get()
                             ->toArray();
=======
        $video_list = Gallery::where("customer_id",$customer_id)
                            ->where('type','=', 'video')->select('id','title','photo','description')
                            ->get()
                            ->toArray();
>>>>>>> fcbae13c698ccae7bcb93f61d60745fef095413c
        return $video_list;
    }

    public function getPanoramabyCustomerId($customer_id) {
        $sql = "SELECT id,photo,title,description,type,'' as path, '' as file FROM galleries WHERE type='panorama' and customer_id=$customer_id";
        $panorama_list = DB::select($sql);
        return $panorama_list;
    }

<<<<<<< HEAD
    public function deleteGallery(Request $request) {
        $request = $request->all();
        if($request['type'] == 'photo') {
            $file = 'upload/nursing_profile/'.$request['photo'];
        } 
        if($request['type'] == 'panorama') {
            $file = 'upload/nursing_profile/Imagepanorama/'.$request['photo'];
        } 
        File::delete($file);
        Gallery::where(['id'=> $request['id']])->delete(); 
        
        // if($request['type'] == 'photo') {
        //     $photo_list = Gallery::select('id','photo','title','description','type')->where("customer_id",$request['customer_id'])
        //                         ->where('type','=', 'photo')
        //                         ->get()
        //                         ->toArray();
        //     return $photo_list;
        // } 
        // if($request['type'] == 'panorama') {
        //     $sql = "SELECT id,photo,title,description,type,'' as path, '' as file FROM galleries WHERE type='panorama' and customer_id=$customer_id";
        //     $panorama_list = DB::select($sql);
        //     return $panorama_list;
        // } 

=======
    public function deltGallery($id,$file)
    {
       $sql = "DELETE from galleries where id = " .$id;
       $delgallery = DB::select($sql);
       $filename = './upload/hospital_profile/'.$file;
    
       \File::delete($filename);
       return response()->json('success');
>>>>>>> fcbae13c698ccae7bcb93f61d60745fef095413c
    }
}