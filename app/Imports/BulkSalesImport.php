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
use App\Models\SalesModel;

class BulkSalesImport implements ToCollection, SkipsEmptyRows, WithHeadingRow, WithValidation{

        /**
     * @param array $row
     *
     * @return Users|null
     */

    public function collection(Collection $rows){
        foreach ($rows->toArray() as $key => $row){
            $inv_info = DB::table('inventory_tbl')->where(DB::raw('LOWER(TRIM(REPLACE(`flower_name`," ","")))'), strtolower(str_replace(' ', '', trim($row['item_name']))))->where('store_id',CRUDBooster::myStoreId())->first();
            $finalPrice = $inv_info->price * $row['quantity'];
           
            if($row['quantity'] > $inv_info->stock){
                return CRUDBooster::redirect(CRUDBooster::adminpath('sales_tbl'),"Quantity Exceed to Stock as Line: ".($key+1),"danger");
            }

            SalesModel::create([
                'inv_id'                  => $inv_info->id,
                'payment_type'            => $row['payment_type'],
                'name_of_customer'        => $row['name_of_customer'],
                'quantity'                => $row['quantity'],
                'price'                   => $finalPrice,
                //'date_of_purchase'        => $row['date_of_purchase'],
                'store_id'                => CRUDBooster::myStoreId(),
                'created_by'              => CRUDBooster::myId(),
                'created_at'              => date('Y-m-d H:i:s')
            ]);
            DB::table('inventory_tbl')
            ->where('id',  $inv_info->id)
            ->decrement('stock', $row['quantity']);
        }
    }

    public function prepareForValidation($data, $index){
        //check flower type
        $data['item_name_exist']['check'] = false;
        $checkRowDb = DB::table('inventory_tbl')->select(DB::raw("LOWER(TRIM(REPLACE(`flower_name`,' ',''))) AS item_name"))->where('store_id',CRUDBooster::myStoreId())->get()->toArray();
        $checkRowDbColumn = array_column($checkRowDb, 'item_name');

        if(in_array(strtolower(str_replace(' ', '', trim($data['item_name']))), $checkRowDbColumn)){
            $data['item_name_exist']['check'] = true;
        }
      
        return $data;
    }

    public function rules(): array
    {
        return [
            '*.item_name_exist' => function($attribute, $value, $onFailure) {
                if ($value['check'] === false) {
                    $onFailure('Invalid Item! Please refer to valid inventory item name in system');
                }
            },
            '*.item_name'           => 'required',
            '*.payment_type'        => 'required',
            '*.name_of_customer'    => 'required',
            '*.quantity'            => 'required',
            '*.price'               => 'required',
            // '*.date_of_purchase'    => 'required',
        ];
    }
}
