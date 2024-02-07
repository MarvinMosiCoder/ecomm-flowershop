<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesModel extends Model
{
    protected $table = 'sales_tbl';

    protected $fillable = [
        'inv_id', 
        'payment_type',
        'name_of_customer',
        'quantity',
        'price',
        'date_of_purchase',
        'store_id',
        'created_by',
        'created_at	',
    ];
}
