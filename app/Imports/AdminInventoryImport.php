<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use CRUDBooster;
use App\Models\InventoryModel;

class AdminInventoryImport implements ToCollection, SkipsEmptyRows, WithHeadingRow, WithValidation{

        /**
     * @param array $row
     *
     * @return Users|null
     */

    public function collection(Collection $rows){
        foreach ($rows->toArray() as $key => $row){
            $flower_type = DB::table('sub_masterfile_flower_type')->where(DB::raw('LOWER(TRIM(REPLACE(`description`," ","")))'), strtolower(str_replace(' ', '', trim($row['flower_type']))))->value('id');
            $store_id = DB::table('stores')->where(DB::raw('LOWER(TRIM(REPLACE(`store_name`," ","")))'), strtolower(str_replace(' ', '', trim($row['store']))))->value('id');

            $save = InventoryModel::updateOrcreate([
                'flower_name'   => trim($row['flower_name']),
                'store_id'      => $store_id
            ],
            [
                'flower_name'   => trim($row['flower_name']), 
                'flower_type'   => $flower_type,   
                'stock'         => DB::raw("IF(stock IS NULL, '".(int)$row['stock']."', stock + '".(int)$row['stock']."')"),  
                // 'arrival'       => DB::raw("IF(arrival IS NULL, '".(int)$row['arrival']."', arrival + '".(int)$row['arrival']."')"),   
                // 'house_stock'   => DB::raw("IF(house_stock IS NULL, '".(int)$row['house_stock']."', house_stock + '".(int)$row['house_stock']."')"),  
                'price'         => $row['price'],             
                'store_id'      => $store_id, 
                'status'        => 'ACTIVE'
              
            ]);
            if ($save->wasRecentlyCreated) {
                $save->created_by     = CRUDBooster::myId();
                $save->created_at     = date('Y-m-d H:i:s');
            }else{
                $save->updated_by     = CRUDBooster::myId();
                $save->updated_at     = date('Y-m-d H:i:s');
            }
            $save->save();
        }
    }

    public function prepareForValidation($data, $index){
        //check flower type
        $data['flower_type_exist']['check'] = false;
        $checkRowDb = DB::table('sub_masterfile_flower_type')->select(DB::raw("LOWER(TRIM(REPLACE(`description`,' ',''))) AS description"))->get()->toArray();
        $checkRowDbColumn = array_column($checkRowDb, 'description');

        if(!empty($data['flower_type'])){
            if(in_array(strtolower(str_replace(' ', '', trim($data['flower_type']))), $checkRowDbColumn)){
                $data['flower_type_exist']['check'] = true;
            }
        }else{
            $data['flower_type_exist']['check'] = true;
        }

         //check Store
         $data['store_exist']['check'] = false;
         $checkRowDbStore = DB::table('stores')->select(DB::raw("LOWER(TRIM(REPLACE(`store_name`,' ',''))) AS stores"))->get()->toArray();
         $checkRowDbStoreColumn = array_column($checkRowDbStore, 'stores');
 
         if(!empty($data['store'])){
             if(in_array(strtolower(str_replace(' ', '', trim($data['store']))), $checkRowDbStoreColumn)){
                 $data['store_exist']['check'] = true;
             }
         }else{
             $data['store_exist']['check'] = true;
         }

        return $data;
    }

    public function rules(): array
    {
        return [
            '*.flower_type_exist' => function($attribute, $value, $onFailure) {
                if ($value['check'] === false) {
                    $onFailure('Invalid Flower Type! Please refer to valid flower type in the system');
                }
            },
            '*.store_exist' => function($attribute, $value, $onFailure) {
                if ($value['check'] === false) {
                    $onFailure('Invalid Store! Please refer to valid Store Name in the system');
                }
            },
            '*.flower_type'    => 'required',
            '*.flower_name'    => 'required',
            '*.price'          => 'required',
            '*.stock'          => 'required',
            '*.store'          => 'required',
        ];
    }
}
