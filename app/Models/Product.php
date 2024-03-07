<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static function productsFilters()
    {
        $productsFilters['fabricArray'] = array('Cotton', 'Polyester', 'Wool');
        $productsFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve');
        $productsFilters['patternArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $productsFilters['fitArray'] = array('Regular', 'Slim', 'OverSize');
        $productsFilters['occasionArray'] = array('Casual', 'Formal');
        return $productsFilters;
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function attributes()
    {
        return  $this->hasMany(ProductsAttribure::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


    public static function getAttributePrice($product_id, $size)
    {
        // Fetch attribute details for the given product and size
        $attributePrice = ProductsAttribure::where(['product_id' => $product_id, 'size' => $size])->first();

        // Check if attribute details are found
        if (!$attributePrice) {
            // Handle the case where no attribute details are found
            return ['error' => 'Attribute details not found for the given product and size'];
        }

        // Fetch product details
        $productDetails = Product::select(['product_discount', 'category_id', 'brand_id'])->where('id', $product_id)->first();

        // Check if product details are found
        if (!$productDetails) {
            // Handle the case where no product details are found
            return ['error' => 'Product details not found for the given product'];
        }

        // Fetch category details
        $categoryDetails = Category::select(['category_discount'])->where('id', $productDetails->category_id)->first();

        // Check if category details are found
        if (!$categoryDetails) {
            // Handle the case where no category details are found
            return ['error' => 'Category details not found for the given product category'];
        }

        // Fetch brand details
        $brandDetails = Brand::select(['brand_discount'])->where('id', $productDetails->brand_id)->first();

        // Check if brand details are found
        if (!$brandDetails) {
            // Handle the case where no brand details are found
            return ['error' => 'Brand details not found for the given product brand'];
        }

        // Initialize variables
        $discount = 0;
        $discount_percent = 0;
        $final_price = $attributePrice->price;

        // Determine applicable discount
        if ($productDetails->product_discount > 0) {
            $discount = $attributePrice->price * $productDetails->product_discount / 100;
            $discount_percent = $productDetails->product_discount;
            $final_price -= $discount;
        } elseif ($categoryDetails->category_discount > 0) {
            $discount = $attributePrice->price * $categoryDetails->category_discount / 100;
            $discount_percent = $categoryDetails->category_discount;
            $final_price -= $discount;
        } elseif ($brandDetails->brand_discount > 0) {
            $discount = $attributePrice->price * $brandDetails->brand_discount / 100;
            $discount_percent = $brandDetails->brand_discount;
            $final_price -= $discount;
        }

        // Return result
        return [
            'product_price' => $attributePrice->price,
            'final_price' => $final_price,
            'discount' => $discount,
            'discount_percent' => $discount_percent
        ];
    }

    public static function productStatus($product_id)
    {
        $productStatus = Product::select('status')->where('id', $product_id)->first();
        return $productStatus->status;
    }


    // get data for order
    public static function getProductDetails($product_id)
    {
        $getProductDetails = Product::where('id', $product_id)->first()->toArray();
        return $getProductDetails;
    }
    public static function getAttributeDetail($product_id, $size)
    {
        $getAttributeDetail = ProductsAttribure::where(['product_id' => $product_id, 'size' => $size])
            ->first()->toArray();
        return $getAttributeDetail;
    }
    // get image
    public static function getProductImage($product_id)
    {
        $image = "";
        $productImageCount = ProductImage::where('product_id', $product_id)->count();
        if ($productImageCount > 0) {
            $getProductImage = ProductImage::select('image')->where('product_id', $product_id)->first();
            $image = $getProductImage->image;
        }
        return $image;
    }
}
