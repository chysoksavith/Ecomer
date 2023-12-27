<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAttribure extends Model
{
    use HasFactory;
    protected $table = 'products_attributes';
    protected $fillable = ['id', 'price', 'stock', 'sku'];


    public static function productStock($product_id, $size)
    {
        $productStock = ProductsAttribure::select('stock')
            ->where(['product_id' => $product_id, 'size' => $size])
            ->first();
        return $productStock->stock;
    }
}
