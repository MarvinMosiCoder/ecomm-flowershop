<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddToCartModel extends Model
{
    protected $table = 'add_to_cart_tbl';

    protected $fillable = [
        'user_id',
        'prod_id',
        'quantity',
        'price'
        
    ];
}
