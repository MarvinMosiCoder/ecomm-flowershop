<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAddresses extends Model
{
    use HasFactory;
    protected $table = 'users_addresses';
    protected $fillable = [
        'user_id',
        'fullname',
        'phone_number',
        'region',
        'province',
        'city',
        'barangay',
        'house_no',
        'postal_code',
        'label_as',
        'is_default',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function scopeAddress($query, $id){
        return $query->where('users_addresses.user_id', $id)
                    ->leftjoin('refregion','users_addresses.region','refregion.id')
                    ->leftjoin('refprovince','users_addresses.province','refprovince.provCode')
                    ->leftjoin('refcitymun','users_addresses.city','refcitymun.citymunCode')
                    ->leftjoin('refbrgy','users_addresses.barangay','refbrgy.id')
                    ->select('users_addresses.*',
                             'refregion.*',
                             'refregion.id AS region_id',
                             'refregion.regDesc AS region_desc',
                             'refprovince.*',
                             'refprovince.id AS province_id',
                             'refcitymun.*', 
                             'refcitymun.id AS city_id',
                             'refbrgy.*', 
                             'refbrgy.id AS brgy_id'
                             )
                    ->get();
    }

    public function scopeAddressDefault($query, $id){
        return $query->where('users_addresses.user_id', $id)
                    ->leftjoin('refregion','users_addresses.region','refregion.id')
                    ->leftjoin('refprovince','users_addresses.province','refprovince.provCode')
                    ->leftjoin('refcitymun','users_addresses.city','refcitymun.citymunCode')
                    ->leftjoin('refbrgy','users_addresses.barangay','refbrgy.id')
                    ->select('users_addresses.*',
                             'refregion.*',
                             'refregion.id AS region_id',
                             'refregion.regDesc AS region_desc',
                             'refprovince.*',
                             'refprovince.id AS province_id',
                             'refcitymun.*', 
                             'refcitymun.id AS city_id',
                             'refbrgy.*', 
                             'refbrgy.id AS brgy_id'
                             )
                    ->whereNotNull('users_addresses.is_default')
                    ->first();
    }
}
