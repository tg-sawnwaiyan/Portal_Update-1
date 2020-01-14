<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use DB;

class GalleryController extends Controller
{
    public function index()
    {
       
    }
    
    public function getPhotobyCustomerId($customer_id) {
        $photo_list = Gallery::where("customer_id",$customer_id)
                            ->where('type','=', 'photo')->select('id','title','photo','description')
                            ->get()
                            ->toArray();
        return $photo_list;
    }

    public function getVideobyCustomerId($customer_id) {
        $video_list = Gallery::where("customer_id",$customer_id)
                            ->where('type','=', 'video')->select('id','title','photo','description')
                            ->get()
                            ->toArray();
        return $video_list;
    }

    public function getPanoramabyCustomerId($customer_id) {
        $sql = "SELECT id,photo,title,description,type,'' as path, '' as file FROM galleries WHERE type='panorama' and customer_id=$customer_id";
        $panorama_list = DB::select($sql);
        // $panorama_list = Gallery::select('id','photo','title','description','type')->where("customer_id",$customer_id)
        //                     ->where('type','=', 'panorama')
        //                     ->get()
        //                     ->toArray();
        return $panorama_list;
    }

    public function deltGallery($id)
    {
       $sql = "DELETE from galleries where id = " .$id;
       $file = 
       $filename = '.upload/hospital_profile/'.$file;
       \File::delete($filename);
       $delgallery = DB::select($sql);
       return response()->json('success');
    }
}