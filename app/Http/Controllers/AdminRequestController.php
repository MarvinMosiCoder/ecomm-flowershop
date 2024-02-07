<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Excel;
use App\Imports\InventoryImport;
use App\Models\InventoryModel;
use App\Models\InventoryImageModel;


class AdminRequestController extends \crocodicstudio\crudbooster\controllers\CBController{

    public function invPrice(Request $request){
        $data = $request->all();	
        $id = $data['id'];
        
        $response = DB::table('inventory_tbl')
                        ->select('inventory_tbl.price as price','stock as stock')
                        ->where('id', $id)
                        ->where('status', "ACTIVE")
                        ->first();

        return($response);
    }

    public function optionsValue(Request $request){
        $data = $request->all();	
        $id = $data['id'];
        
        $response = DB::table('sub_masterfile_flower_type')
                        ->select('sub_masterfile_flower_type.*','sub_masterfile_flower_type.description as text')
                        ->where('status', "ACTIVE")
                        ->get();

        return json_encode($response);
    }

    public function saveInventory(Request $request){
        $data = $request->all();	
        $files = $data['files'];

        $tableRowData = json_decode($data['tableRowData']);
     
        //dd($data,$tableRowData);

        $data= json_decode($data['form_data'],true);
        $type_of_flower   = $data['type_of_flower'];
        $flower_name      = $data['flower_name'];
        $item_description = $data['item_description'];
        $price            = $data['price'];
        $percent_sale     = $data['percent_sale'];
        $quantity         = $data['quantity'];

        $getLastId = InventoryModel::Create(
            [
                'flower_type'            => $type_of_flower, 
                'flower_name'            => $flower_name,
                'item_description'       => $item_description,
                'price'                  => $price,
                'percent_sale'           => $percent_sale,
                'stock'                  => $quantity,
                'created_by'             => CRUDBooster::myId(),
                'created_at'             => date('Y-m-d H:i:s')
            ]
        );     
        
        $id = $getLastId->id;

        $images = [];
        if (!empty($files)) {
            $counter = 0;
            foreach($files as $file){
                $counter++;
                $name = time().rand(1,50) . '.' . $file->getClientOriginalExtension();
                $filename = $name;
                $file->move('vendor/crudbooster/inventory_images',$filename);
                $images[]= $filename;

                $header_images               = new InventoryImageModel;
                $header_images->inv_id       = $id;
                $header_images->file_name    = $filename;
                $header_images->ext 	     = $file->getClientOriginalExtension();
                $header_images->created_by   = CRUDBooster::myId();
                $header_images->save();
            }
        }

        $message = ['status'=>'success', 'message' => 'Success!'];
		echo json_encode($message);
    }

    public function autocompleteSearch(Request $request){
        $searchquery = $request->searchquery;
        $data = InventoryModel::where('flower_name','like','%'.$searchquery.'%')->take(10)->get();
        return response()->json($data);
    }

    public function getSearchData(Request $request){
        $id = $request->all();
        $data = InventoryModel::where('id',$id)->first();
        return response()->json($data);
    }
       
}

?>
