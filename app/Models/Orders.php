<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = "orders";

    public function orders_products()
    {
        return $this->hasMany(Order_Product::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function log()
    {
        return $this->hasMany(OrderLog::class, 'order_id')->orderBy('id', 'Desc');
    }
    public static function getOrderStatus($order_id)
    {
        $getOrderStatus = self::select('order_status')->where('id', $order_id)->first();
        return $getOrderStatus->order_status;
    }
}
