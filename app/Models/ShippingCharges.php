<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharges extends Model
{
    use HasFactory;
    protected $table = "shipping_charges";

    public static function getShippingCharges($country, $total_weight)
    {
        $shippingDetails = self::where('country', $country)->first();

        if ($shippingDetails !== null) {
            $shippingDetails = $shippingDetails->toArray();

            if ($total_weight > 0) {
                if ($total_weight > 0 && $total_weight <= 500) {
                    $rate =  $shippingDetails['0_500g'];
                } else if ($total_weight > 500 && $total_weight <= 1000) {
                    $rate =  $shippingDetails['501_1000g'];
                } else if ($total_weight > 1000 && $total_weight <= 2000) {
                    $rate =  $shippingDetails['1001_2000g'];
                } else if ($total_weight > 2000 && $total_weight <= 5000) {
                    $rate =  $shippingDetails['2001_5000g'];
                } else if ($total_weight > 5000) {
                    $rate =  $shippingDetails['above_5000g'];
                } else {
                    $rate = 0;
                }
            } else {
                $rate = 0;
            }
        } else {
            $rate = 0; // Handle the case where no shipping details are found for the country
        }

        return $rate;
    }
}
