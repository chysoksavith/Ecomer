<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ProductsFilter extends Model
{
    use HasFactory;

    public static function getColors($catIds)
    {
        $getProductIds = Product::select('id')
            ->whereIn('category_id', $catIds)
            ->pluck('id');
        $getProductColors = Product::select('family_color')
            ->whereIn('id', $getProductIds)
            ->groupBy('family_color')
            ->pluck('family_color');
        // dd($getProductColors);
        return $getProductColors;
    }

    // get size
    public static function getSizes($catIds)
    {
        $getProductIds = Product::select('id')->whereIn('category_id', $catIds)->pluck('id');
        $getProductSizes = ProductsAttribure::select('size')
            ->where('status', 1)
            ->whereIn('product_id', $getProductIds)
            ->groupBy('size')
            ->pluck('size');
        return $getProductSizes;
    }
    // get Brands
    public static function getBrands($catIds)
    {
        $getProductIds = Product::select('id')->whereIn('category_id', $catIds)->pluck('id');
        $getProductBrandIds = Product::select('brand_id')
            ->whereIn('id', $getProductIds)
            ->groupBy('brand_id')
            ->pluck('brand_id');
        $getProductBrands = Brand::select('id', 'brand_name')
            ->where('status', 1)->whereIn('id', $getProductBrandIds)
            ->orderBy('brand_name', 'ASC')
            ->get();
        return $getProductBrands;
    }
    // get filter
    public static function getDynamicFilters($catIds)
    {
        $getProductIds = Product::select('id')->whereIn('category_id', $catIds)->pluck('id');

        $getFilterColumns = ProductsFilter::select('filter_name')->pluck('filter_name');

        $getFilterValues = collect([]);

        foreach ($getFilterColumns as $filterName) {
            $values = Product::select($filterName)
                ->whereIn('id', $getProductIds)
                ->where('status', 1)
                ->distinct()
                ->pluck($filterName);

            $getFilterValues = $getFilterValues->merge($values);
        }

        $getFilterValues = $getFilterValues->filter()->unique()->values();

        $getCategoryFilterColumns = ProductsFilter::select('filter_name')
            ->whereIn('filter_value', $getFilterValues)
            ->groupBy('filter_name')
            ->orderBy('sort', 'asc')
            ->where('status', 1)
            ->pluck('filter_name');

        return $getCategoryFilterColumns;
    }

    public static function selectedFilters($filter_name, $catIds)
    {
        // Retrieve all distinct values for the given filter name and category IDs
        $productFilters = Product::select($filter_name)
            ->whereIn('category_id', $catIds)
            ->where('status', 1)
            ->groupBy($filter_name)
            ->get();

        // Flatten and filter unique values
        $productFilters = array_filter(array_unique(Arr::flatten($productFilters)));

        return $productFilters;
    }
    // filter type
    public static function filterType(){
        $filterType = ProductsFilter::select('filter_name')->groupBy('filter_name')->where('status', 1)->get()->toArray();
        $filterType = Arr::flatten($filterType);
        return $filterType;
    }
}
