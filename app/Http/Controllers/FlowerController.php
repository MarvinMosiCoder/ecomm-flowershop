<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\InventoryModel;
use App\Models\AddToCartModel;
use Auth;

class FlowerController extends Controller{
    public function index(){
        $data = [];
        $data['flowers'] = InventoryModel::leftjoin('inventory_image','inventory_tbl.id','=','inventory_image.inv_id')
        ->select('*','inventory_image.file_name','inventory_tbl.id as inv_id')
        ->paginate(10);
        $data['main_category'] = DB::table('sub_masterfile_flower_type')->get();
        return view('index',$data);
    }

    public function getDetails($id){
        $data = [];
        $data['flowers'] = InventoryModel::leftjoin('inventory_image','inventory_tbl.id','=','inventory_image.inv_id')
        ->select('*','inventory_image.file_name')
        ->where('inventory_tbl.id',$id)
        ->first();
        return view('flower-detail',$data);
    }

    public function getProductDetails($id){
 
        if($id != 0){
            $data = InventoryModel::leftjoin('inventory_image','inventory_tbl.id','=','inventory_image.inv_id')
            ->select('*','inventory_image.file_name')
            ->whereRaw('flower_type IN ('.$id.')')
            ->get();
        }else{
            $data = InventoryModel::leftjoin('inventory_image','inventory_tbl.id','=','inventory_image.inv_id')
            ->select('*','inventory_image.file_name')
            ->get();
        }
        
       echo json_encode($data);
   }
}
