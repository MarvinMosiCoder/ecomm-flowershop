<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddToCartModel extends Model{
    protected $table = 'add_to_cart_tbl';

    protected $fillable = [
        'user_id',
        'prod_id',
        'quantity',
        'price',
        'standard_shipping'
        
    ];

    public function scopeCartDetail($query, $ids, $userId){
        return $query->leftjoin('inventory_tbl','add_to_cart_tbl.prod_id','=','inventory_tbl.id')
                    ->leftjoin('inventory_image','inventory_tbl.id','=','inventory_image.inv_id')
                    ->select('*','add_to_cart_tbl.id AS cart_id','add_to_cart_tbl.price AS cart_price')
                    ->where('user_id', $userId)
                    ->whereIn('add_to_cart_tbl.id',$ids)
                    ->get();
    }
}
