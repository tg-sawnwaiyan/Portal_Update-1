<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HospitalProfile;
use App\Gallery;
use App\Schedule;
use DB;
use App\Medical;
use App\Category;

use App\Customer;
use App\SubjectJunctions;
use App\SpecialFeaturesJunctions;

class HospitalProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    function getFavouriteHospital($local_sto) {
        $query = "SELECT hospital_profiles.* , '' AS schedule_am, '' AS schedule_pm, group_concat(special_features_junctions.special_feature_id) AS special, group_concat(subject_junctions.subject_id) AS sub, customers.name, customers.email, customers.phone, customers.logo, townships.township_name, townships.city_id, cities.city_name FROM `hospital_profiles`
                    JOIN customers ON hospital_profiles.customer_id = customers.id
                    LEFT JOIN townships ON townships.id = customers.townships_id
                    LEFT JOIN cities ON townships.city_id = cities.id
                    LEFT JOIN special_features_junctions ON special_features_junctions.customer_id = customers.id
                    LEFT JOIN subject_junctions ON subject_junctions.customer_id = customers.id
                    WHERE hospital_profiles.id IN (" . $local_sto . ") GROUP BY customers.id";
        $fav_hospital = DB::select($query);
        foreach($fav_hospital as $fav) {
            $sfeature = $fav->special;
            if($sfeature != null){
                $sql = "SELECT short_name FROM special_features WHERE id IN (".$sfeature.")";
                $specialfeature = DB::select($sql);
                $fav->special = $specialfeature;
            }
            $subject = $fav->sub;
            if($subject != null){
                $sql = "SELECT name FROM subjects WHERE id IN (".$subject.")";
                $subjects = DB::select($sql);
                $fav->sub = $subjects;
            }
            $cId = $fav->customer_id;
            $sql = "SELECT schedule.* FROM schedule WHERE schedule.customer_id = $cId AND schedule.part = 'am'";
            $schedule_am = DB::select($sql);
            $fav->schedule_am = $schedule_am;
            $sql = "SELECT schedule.* FROM schedule WHERE schedule.customer_id = $cId AND schedule.part = 'pm'";
            $schedule_pm = DB::select($sql);
            $fav->schedule_pm = $schedule_pm;
        }
        return $fav_hospital;
    }

    function getFavouriteNursing($local_sto) {
        $query = "SELECT nursing_profiles.* , group_concat(special_features_junctions.special_feature_id) AS special,'' AS payment_method, customers.name, customers.email, customers.address, customers.logo, townships.township_name, townships.city_id, cities.city_name FROM `nursing_profiles`
                    LEFT JOIN customers ON nursing_profiles.customer_id = customers.id
                    LEFT JOIN townships ON townships.id = customers.townships_id
                    LEFT JOIN cities ON townships.city_id = cities.id
                    LEFT JOIN special_features_junctions ON special_features_junctions.customer_id = customers.id
                    WHERE nursing_profiles.id IN (" . $local_sto . ") GROUP BY customers.id";
        $fav_nursing = DB::select($query);
        foreach($fav_nursing as $nur) {
            if($nur->special != null){
                $sfeature = $nur->special;
                $cId = $nur->customer_id;
                if($sfeature != null){
                    $sql = "SELECT short_name FROM special_features WHERE id IN (".$sfeature.")";
                    $specialfeature = DB::select($sql);
                    $nur->special = $specialfeature;
                }            
                $sql = "SELECT * FROM method_payment WHERE customer_id = $cId";
                $payment = DB::select($sql);
                $nur->payment_method = $payment;                
            }
            

            
        }
        
        return $fav_nursing;
    }

    public function getPostalList($postal){
        $postal = (int)$postal;
        $query = "SELECT * FROM zipcode WHERE zip7_code LIKE '".$postal."%'";
        $postal_list = DB::select($query);
        return $postal_list;
    }

    public function getCitiesName() {
        $query = "SELECT cities.id, cities.city_name FROM cities";
        $city_list = DB::select($query);
        return $city_list;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hospital = HospitalProfile::where('customer_id',$id)->first();
       
        return response()->json($hospital);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favourite_list = HospitalProfile::find($id);
        $favourite_list->delete();
        return response()->json('The successfully deleted');
    }

    public function movePhoto(Request $request) {
        $request = $request->all();
        foreach ($request as $file){
            $destination = 'upload/hospital_profile/'.$file->getClientOriginalName();
            $upload_img = move_uploaded_file($file, $destination);
        }        
    }
    
    public function profileupdate($id,Request $request) {
        $request = $request->all();
        
        print_r($request);
        // Customer Profile
        $customer = Customer::find($id);

        $customer->name = $request[0]['name'];
        $customer->email = $request[0]['email'];
        $customer->phone = $request[0]['phone'];
        $customer->address = $request[0]['address'];
        $customer->townships_id = $request[0]['township']; 
        $customer->save();
        // End 

        // Hospital Profile
        $hospital = HospitalProfile::where('customer_id',$id);
        $uploadData = array(
            'access' => $request[0]['access'],
            'specialist' =>  $request[0]['specialist'],
            'details_info'=>  $request[0]['detail_info'],
            'closed_day' =>  $request[0]['close_day'],
            'facilities' =>  $request[0]['facilities'],
            'website' =>  $request[0]['website'],
            'congestion' =>  $request[0]['congestion'],
            'latitude' =>  $request[0]['latitude'],
            'longitude' =>  $request[0]['longitude']
       );
       $hospital->update($uploadData);
       // End 

        // Schedule 
        $schedule = Schedule::where('customer_id', $id)
                    ->delete();

        for($i=0; $i<2; $i++) {
            if($i == 0) { $part = 'am'; } else { $part = 'pm'; }
            $data = array(
                'customer_id' => $id,
                'mon' => $request[0]['schedule_list'][$i][0],
                'tue' => $request[0]['schedule_list'][$i][1],
                'wed' => $request[0]['schedule_list'][$i][2],
                'thu' => $request[0]['schedule_list'][$i][3],
                'fri' => $request[0]['schedule_list'][$i][4],
                'sat' => $request[0]['schedule_list'][$i][5],
                'sun' => $request[0]['schedule_list'][$i][6],
                'part' => $part,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s') 
            );
            DB::table('schedule')->insert($data);
        // End
        }

        // Special Feature
        $feature = SpecialFeaturesJunctions::where('customer_id', $id)
                    ->delete();

        for($indx=0; $indx<count($request[0]['chek_feature'][0]['special_feature_id']); $indx++) {
            $new_feature = new SpecialFeaturesJunctions();
            $new_feature->customer_id = $id;
            $new_feature->special_feature_id = $request[0]['chek_feature'][0]['special_feature_id'][$indx];
            $new_feature->save();
        }
        // End

        // SubjectJuncitonsUpdate 
        $subject = SubjectJunctions::where('customer_id', $id)
                    ->delete();

        for($indx=0; $indx<count($request[0]['subjects'][0]['subject_id']); $indx++) {
            $new_subject = new SubjectJunctions();
            $new_subject->customer_id = $id;
            $new_subject->subject_id = $request[0]['subjects'][0]['subject_id'][$indx];
            $new_subject->save();
        }
        // End

        // Photo And Video 
        $gallery = Gallery::where('customer_id', $id)
                        ->delete();

        for($i=0; $i<count($request[0]['gallery_list']); $i++) {
            $data = array(
                'customer_id' => $id,
                'type' => $request[0]['gallery_list'][$i]['type'],
                'photo'=> $request[0]['gallery_list'][$i]['photo'],
                'title'=> $request[0]['gallery_list'][$i]['title'],
                'description'=> $request[0]['gallery_list'][$i]['description'],
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            );
            DB::table('galleries')->insert($data);
        }
        // End
    }

}
