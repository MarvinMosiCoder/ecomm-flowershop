<?php

namespace App\Http\Controllers\auth;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use DB;
use App\Models\InventoryModel;
use App\Models\AddToCartModel;
use Auth;

class DashboardController extends Controller{

    public function index() {
        $data = [];
        $data['flowers'] = InventoryModel::leftjoin('inventory_image','inventory_tbl.id','=','inventory_image.inv_id')
        ->select('*','inventory_image.file_name')
        ->paginate(10);
        $data['my_cart'] = AddToCartModel::select('*')->where('user_id', Auth::id())->count();
        $data['main_category'] = DB::table('sub_masterfile_flower_type')->get();
        return view('user-frontend.views.index', $data);
    }

    public function getDetails($id){
        $data = [];
        $data['flowers'] = InventoryModel::leftjoin('inventory_image','inventory_tbl.id','=','inventory_image.inv_id')
        ->select('*','inventory_image.file_name')
        ->where('inventory_tbl.id',$id)
        ->first();
        $data['my_cart'] = AddToCartModel::select('*')->where('user_id', Auth::id())->count();
        // dd(Auth::id());
        return view('user-frontend.views.flower-detail',$data);
    }

    public function getDetailsCart(){
        $data = [];
        $data['my_cart_detail'] = AddToCartModel::leftjoin('inventory_tbl','add_to_cart_tbl.prod_id','=','inventory_tbl.id')
                                 ->leftjoin('inventory_image','inventory_tbl.id','=','inventory_image.inv_id')
                                 ->select('*','add_to_cart_tbl.id AS cart_id','add_to_cart_tbl.price AS cart_price')->where('user_id', Auth::id())->get();
        $data['my_cart'] = AddToCartModel::select('*')->where('user_id', Auth::id())->count();
        //dd($data['my_cart_detail']);
        return view('user-frontend.views.cart-detail',$data);
    }

}
 