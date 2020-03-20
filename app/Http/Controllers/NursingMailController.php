<?php

namespace App\Http\Controllers;

use App\NursingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\nursingMailing;
use App\Mail\userNursingMail;
use App\Mail\adminNursingMail;
class NursingMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mail(Request $request){
      
        $favourite_mail = $request->fav_mail;
        $favourite_id = $request->fav_id;
        $favourite_name = $request->fav_name;
       
        $fav_documentation = $request->arr_document;
     
         for($i = 1; $i<count($favourite_id); $i++){
            
            $request->related_fav_id = 500000+intval($favourite_id[$i]);
            $request->related_fav_name = $favourite_name[$i];  
           
         
            if(isset($fav_documentation[$favourite_id[$i]])){
           
                if ($fav_documentation[$favourite_id[$i]] == true ) {
                   $name_arr[] = $request->fav_name[$i];
                
                   $request->fav_name_copy = $name_arr;
                    \Mail::to($favourite_mail[$i])->send(new nursingMailing($request));
                } 
              
            }     
     
    
    }      

        $admin_email = 'admin@t-i-s.jp';
       
        \Mail::to($admin_email)->send(new adminNursingMail($request));

        if($request->mail != null || $request->mail != '')
        {        
            \Mail::to($request->mail)->send(new userNursingMail($request));
        }

        return response()->json(['success'=>'Done!']);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NursingMail  $nursingMail
     * @return \Illuminate\Http\Response
     */
    public function show(NursingMail $nursingMail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NursingMail  $nursingMail
     * @return \Illuminate\Http\Response
     */
    public function edit(NursingMail $nursingMail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NursingMail  $nursingMail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NursingMail $nursingMail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NursingMail  $nursingMail
     * @return \Illuminate\Http\Response
     */
    public function destroy(NursingMail $nursingMail)
    {
        //
    }
}