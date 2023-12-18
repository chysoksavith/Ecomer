<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static function productsFilters(){
        $productsFilters['fabricArray'] = array('Cotton', 'Polyester', 'Wool');
        $productsFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve');
        $productsFilters['patternArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $productsFilters['fitArray'] = array('Regular', 'Slim');
        $productsFilters['occasionArray'] = array('Casual', 'Formal');
        return $productsFilters;
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
