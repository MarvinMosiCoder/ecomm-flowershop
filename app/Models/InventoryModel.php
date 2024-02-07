<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryModel extends Model{
    protected $table = 'inventory_tbl';
    protected $fillable = [
        'flower_type', 
        'flower_name',
        'item_description',
        'arrival',
        'stock',
        'house_stock',
        'price',
        'status',
        'store_id',
        'percent_sale',
        'created_by',
        'created_at	',
        'updated_by',
        'updated_at	',
        'status'
    ];

}
