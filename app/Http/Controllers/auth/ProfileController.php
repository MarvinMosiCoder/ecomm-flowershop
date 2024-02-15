<?php

namespace App\Http\Controllers\auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersAddresses;
use Auth;
use App\Models\AddToCartModel;
use DB;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = [];
        $data['page_title'] = 'Your profile';
        $data['detail'] = User::select('*')->where('id', Auth::id())->first();
        $data['my_cart'] = AddToCartModel::select('*')->where('user_id', Auth::id())->count();
        return view('user-frontend.views.profile', $data);
    }

    public function myAddresses(){
        $data = [];
        $data['page_title'] = 'My Addresses';
        $data['detail'] = User::select('*')->where('id', Auth::id())->first();
        $data['my_cart'] = AddToCartModel::select('*')->where('user_id', Auth::id())->count();
        $data['my_addresses'] = UsersAddresses::address(Auth::id());
        $data['regions'] = DB::table('refregion')->select('*')->get();
        return view('user-frontend.views.addresses', $data);
    }

    public function getProvince(Request $request){
        $user_request = $request->all();
        $location_id = $user_request['location_id'];
        $items = DB::table('refprovince')->select('refprovince.*')->where('regCode', $location_id)->get();
        return response()->json(['items'=> $items]);
    }

    public function getCity(Request $request){
        $user_request = $request->all();
        $location_id = $user_request['location_id'];
        $items = DB::table('refcitymun')->select('refcitymun.*')->where('provCode', $location_id)->get();
        return response()->json(['items'=> $items]);
    }

    public function getBrgy(Request $request){
        $user_request = $request->all();
        $location_id = $user_request['location_id'];
        $items = DB::table('refbrgy')->select('refbrgy.*')->where('citymunCode', $location_id)->get();
        return response()->json(['items'=> $items]);
    }

    public function addAddress(Request $request){
        $data = $request->all();
        if($request->is_default){
            $isDefault = $request->is_default;
        }else{
            $isDefault = NULL;
        }
        UsersAddresses::Create(
        [
            'user_id'      => Auth::id(), 
            'fullname'     => $request->fullname,
            'phone_number' => $request->phone_number,
            'region'       => $request->region,
            'province'     => $request->province,
            'city'         => $request->city,
            'barangay'     => $request->brgy,
            'house_no'     => $request->house_no,
            'postal_code'  => $request->postal_code,
            'label_as'     => $request->label_as,
            'is_default'   => $request->is_default,
            'created_at'   => date('Y-m-d H:i:s')
        ]
        );        
        $message = ['status'=>'success', 'message' => 'Success!'];
        echo json_encode($message);
    }

}
