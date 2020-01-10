<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\User;
use App\NursingProfile;
use App\HospitalProfile;
use DB;
use Auth;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {        
        // $customers = Customer::all()->toArray();
        // return array_reverse($customers);
        $customer =Customer::where('type_id',$type)->orderBy('created_at', 'desc')->get();
        return response()->json($customer);
    }

    public function uploadvideo(Request $request)
    {
        $request = $request->all();
        $video_file = $request['file'];
        $video_name = $request['name'];

        $destination = 'upload/videos/'.$video_name;
        if (move_uploaded_file($video_file, $destination)) {
            return response()->json(['success'=>'Done!']);
        } else {
           echo "File was not uploaded";
        }
    }

    public function deletevideo(Request $request)
    {
        $request = $request->all();
        $file_path = $request['fiel_path'];

        unlink($file_path);
        return response()->json(['success'=>'Done!']);

    }

    public function add(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|max:20|same:password',
            'address' => 'required',

        ],[
            'name.required' => 'Name is required',
        ]);
        $imageName = $request->logo->getClientOriginalName();
        $request->logo->move(public_path('images'), $imageName);
        $customer = new Customer ([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'logo' => $request->logo->getClientOriginalName(),
            'type_id' => 1,
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'recordstatus' => 2


        ]);
        $customer ->save();
        return response()->json(['success'=>'Done!']);

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        //
    }


    public function edit($id)
    {
        $sql = "SELECT *, (CASE c.type_id WHEN '2' THEN CONCAT((200000+c.id)) ELSE CONCAT((500000+c.id)) END) as cusnum FROM customers as c WHERE c.id = ".$id;
        $customer = DB::select($sql);

        return response()->json($customer[0]);
    }

    public function getCustomerInfo($id) {
        $customer = Customer::find($id);

        return response()->json($customer);
    }

    public function update($id,Request $request)
    {
        if($id == 0) {
            $u_id = auth('api')->user()->id;
            $id = User::where('id',$u_id)->select('customer_id')->value('customer_id');
        }
        $customer = Customer::find($id);
        $customer->update($request->all());
        return response()->json('Customer successfully updated');
    }


    public function destroy($id)
    {
        //
        $customer = Customer::find($id);
        $customer->delete();

        $user = User::where('customer_id',$id)->first();
        if($user !== null){
            $user->delete();
        }        

        $nursing = NursingProfile::where('customer_id',$id)->first();
        if($nursing !== null){
            $nursing->delete();
        }
        
        $hospital = HospitalProfile::where('customer_id',$id)->first();
        if($hospital !== null){
            $hospital->delete();
        }
        
        $customers = Customer::all();
        $data = array("status"=>"deleted", "customers"=>$customers);
        return response()->json($data);
    }

    public function confirm($id)
    {
      
        $getCustomer = Customer::findOrFail($id);

        $query = "SELECT c.latitude,c.longitude FROM cities as c
                       left join  townships as t on t.city_id = c.id
                       left join customers as cu on cu.townships_id = t.id
                       where cu.id = " .$id. " group by c.id";
                     
        $citylatlng = DB::select($query);
    
        $checkUser = User::where('email',$getCustomer->email)->select('email')->value('email');
        // $getUserId = User::where('email',$getCustomer->email)->value('id');
        $comfirmUser =  auth('api')->user()->id;
        if(!empty($checkUser)){            
            return response()->json('already');
        }else{
            \Mail::to($getCustomer->email)->send(new SendMailable($getCustomer));
           
            $data = array(
                'name'=>$getCustomer->name,
                'email'=>$getCustomer->email,
                'password'=>$getCustomer->password,
                'role' => 1,
                'type_id' => $getCustomer->type_id,
                'customer_id' =>$getCustomer->id
            );
            DB::table('users')->insert($data);
            $insert = array(
                'customer_id' => $getCustomer->id,
                'latitude' => $citylatlng[0]->latitude,
                'longitude' => $citylatlng[0]->longitude,

               );            
            $lastid = User::where('email',$getCustomer->email)->select('id')->value('id'); //user table last id
            $model_has_roles = array(
                'role_id'=>2,   
                'model_type'=> 'App\User',
                'model_id'=> $lastid,
            );
         
            if($getCustomer->type_id == 2){ 

                \DB::table('hospital_profiles')->insert($insert);
            }else{
       
                \DB::table('nursing_profiles')->insert($insert);
            }  
           DB::table('model_has_roles')->insert($model_has_roles);
            
            $cus = Customer::find($id);
            $cus->status = 1; 
            $cus->confirm_user_id = $comfirmUser;
            $cus->user_id = $lastid;
            $cus->save();

            $customers = Customer::all();
            $data = array("status"=>"success", "customers"=>$customers);
            return response()->json($data);
        }
    }


    public function search(Request $request)
    {
        $request = $request->all();
        $search_word = $request['search_word'];

        $search_customer = Customer::query()
                            ->where('name', 'LIKE' , "%{$search_word}%")
                            ->orderBy('id','DESC')
                            ->get()
                            ->toArray();
        return $search_customer;
    }

    public function accountStatusUpdate(Request $request)
   {
       $request = $request->all();      
    //    $user = User::find(auth('api')->user()->id);       
       $cusId = $request['cus_id'];
       if(auth()->user()->role == 2) {
           $customer = Customer::find($cusId);
           $user = User::find($customer['user_id']);
       }else{
           $user = User::find(auth('api')->user()->id);
       } 

       $customer = Customer::find($user['customer_id']);
      
        if($request['status'] == '1') { 
            $customer->recordstatus = '0'; } 
        if($request['status'] == '0') { 
            $customer->recordstatus = '1';
        }
      
       $customer->save();

       return response()->json($customer);
   }
}
