<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // public function parentCategory()
    // {
    // return $this->hasOne(Category::class, 'id', 'parent_id')->select('id', 'category_name', 'url')->where('status', 1);
    // }
    // public function subCategories()
    // {
    //     return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    // }
    // public static function getCategories()
    // {
    //     return static::with(['subCategories' => function ($query) {
    //         $query->with('subCategories');
    //     }])
    //         ->where('parent_id', 0)
    //         ->where('status', 1)
    //         ->get()
    //         ->toArray();
    // }
    public function parentCategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id')->select('id', 'category_name', 'url')->where('status', 1);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('status', 1);
    }

    public static function getCategories()
    {
        $getCategories = static::with(['subCategories' => function ($query) {
            $query->with('subCategories');
        }])
            ->where('parent_id', 0)
            ->where('status', 1)
            ->get();

        return $getCategories;
    }
    public static function categoryDetails($url)
    {
        $categoryDetails = Category::select('id', 'category_name', 'url', 'parent_id')->with('subCategories')
            ->where('url', $url)
            ->first();

        if (!$categoryDetails) {
            abort(404); // Handle the case where the category is not found
        }

        // Now, $categoryDetails is an Eloquent model with the 'subCategories' relationship loaded
        $catIds = collect([$categoryDetails->id]);

        foreach ($categoryDetails->subCategories as $subcat) {
            $catIds->push($subcat->id);
        }

        if ($categoryDetails->parent_id == 0 || $categoryDetails->parent_id == 1 || $categoryDetails->parent_id == 2 || $categoryDetails->parent_id == 3) {
            // only show main category in Breadcrumb
            $breadCrumb = '<span class="btnTitleIte"> <a href="' . url($categoryDetails->url) . '"> ' . $categoryDetails->category_name . ' </a> </span>';
        } else {
            // Show main and sub category in breadCrumb
            $parentCategory = Category::select('category_name', 'url')->where('id', $categoryDetails->parent_id)->first();
            $breadCrumb = '<span class="btnTitleIte "> <a href="' . url($parentCategory->url) . '"> ' . $parentCategory->category_name . ' </a> </span>
                           <span class="btnTitleIte"> <a href="' . url($categoryDetails->url) . '"> ' . $categoryDetails->category_name . ' </a> </span>';
        }

        return (object) ['catIds' => $catIds, 'categoryDetails' => $categoryDetails, 'breadCrumb' => $breadCrumb];
    }

    public static function getCategoryStatus($category_id)
    {
        $getCategoryStatus = Category::select('status')->where('id', $category_id)->first();
        return $getCategoryStatus->status;
    }
}
