<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeliveryAddresses extends Model
{
    use HasFactory;
    protected $table = "delivery_addresesses";
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'mobile',
        'status'
    ];

    public static function deliveryAddresses()
    {
        $user_id = Auth::user()->id;

        $deliveryAddress = DeliveryAddresses::where('user_id', $user_id)->get()->toArray();
        return $deliveryAddress;
    }
}
