<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharges extends Model
{
    use HasFactory;
    protected $table = "shipping_charges";

    public static function getShippingCharges($country)
    {
        $getShippingCharges = self::select('rate')->where('country', $country)->first();
        return $getShippingCharges->rate;
    }
}
