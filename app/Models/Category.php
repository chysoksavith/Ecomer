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
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
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
}
