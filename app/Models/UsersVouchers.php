<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersVouchers extends Model
{
    use HasFactory;
    protected $table = 'users_vouchers';

    public function scopeZeroMinSpendActive($query,  $id){
        return $query->select('*')
        ->leftjoin('vouchers','users_vouchers.voucher_id','vouchers.id')
        ->where('users_vouchers.user_id', $id)
        ->whereNotNull('users_vouchers.is_used')
        ->where('vouchers.status', 'ACTIVE')
        ->where('users_vouchers.status', 'ACTIVE')  
        ->where('vouchers.min_spend', 0)  
        ->first();
    }

    public function scopeRequiredMinSpendActive($query, $minSpend, $id){
        return $query->select('*')
        ->leftjoin('vouchers','users_vouchers.voucher_id','vouchers.id')
        ->where('users_vouchers.user_id', $id)
        ->whereNotNull('users_vouchers.is_used')
        ->where('vouchers.status', 'ACTIVE')
        ->where('users_vouchers.status', 'ACTIVE')  
        ->where('vouchers.min_spend', '!=', 0)
        ->where('vouchers.min_spend', '<',$minSpend)  
        ->first();
    }
}
