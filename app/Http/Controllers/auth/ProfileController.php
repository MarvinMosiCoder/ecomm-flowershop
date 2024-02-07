<?php

namespace App\Http\Controllers\auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersAddresses;
use Auth;
use App\Models\AddToCartModel;
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
        $data['my_addresses'] = UsersAddresses::select('*')->where('user_id', Auth::id())->get();
        return view('user-frontend.views.addresses', $data);
    }

}
