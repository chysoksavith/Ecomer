<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CmsController;
use App\Http\Controllers\admin\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/admin'], function () {

    Route::group(['middleware' => ['admin']], function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('admin.index');
            Route::get('logout', 'logout')->name('admin.logout');
            // password
            Route::match(['get', 'post'],'update-password', 'updatePassword')->name('admin.update.password');
            Route::match(['get', 'post'],'update-detail', 'updateAdminDetail')->name('admin.update.adminDetails');
            Route::post('check-current-password', 'checkCurrentPassword')->name('admin.checkCurrent.password');
            // subadmin
            Route::get('subadmin', 'subadmin')->name('admin.subadmin');
            Route::post('update-subadmin-status', 'SubAdminStatus' );
            Route::get('delete-subadmin/{id?}', 'Subadmindestroy');
            Route::match(['get','post'], 'add-edit-subadmin/{id?}', 'addedit_subadmin')->name('admin-addedit-subadmin');
            Route::match(['get','post'], 'update-role/{id?}', 'updateRoles')->name('admin-updateRoles');

        });
        // Cms pages
        Route::controller(CmsController::class)->group(function(){
            Route::get('cms-pages', 'index')->name('admin.cmspages');
            Route::post('update-cms-pages-status', 'update')->name('admin.cmspages.update');
            Route::match(['get','post'], 'add-edit-cms-pages/{id?}', 'edit')->name('admin-addedit-cms-page');
            Route::get('delete-cms-pages/{id?}', 'destroy');
        });
        // Categories
        Route::controller(CategoryController::class)->group(function(){
            Route::get('categories', 'categories')->name('admin.categories');
            Route::post('update-category-status', 'updateCategoryStatus')->name('admin.update.category.status');
            Route::get('delete-category/{id?}', 'deleteCategory');
            Route::get('delete-category-image/{id?}', 'deleteCategoryImage');
            Route::match(['get', 'post'], 'add-edit-category/{id?}', 'AddUpdateCategorys')->name('admin.add.edit.category');
        });
        // Product
        Route::controller(ProductsController::class)->group( function(){
            Route::get('products', 'products')->name('admin.products');
            Route::match(['get', 'post'], 'add-edit-product/{id?}', 'AddUpdateProducts')->name('admin.add.edit.product');
            Route::post('update-product-status', 'updateProductStatus')->name('admin.update.product.status');
            Route::get('delete-product/{id?}', 'deleteProduct');
            Route::get('delete-product-video/{id?}', 'deleteProductVideo');
            Route::get('delete-product-image/{id?}', 'deleteProductImage');
            Route::post('update-attribute-status', 'updateAttributeStatus')->name('admin.update.attribute.status');
            Route::get('delete-attribute/{id?}', 'deleteAttribute');
        });
        // Brands
        Route::controller(BrandsController::class)->group(function(){
            Route::get('brands', 'brands')->name('admin.brands');
            Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'AddUpdateBrands')->name('admin.add.edit.brand');
            Route::post('update-brand-status', 'updateBrandStatus')->name('admin.update.brand.status');
            Route::get('delete-brand/{id?}', 'deleteBrand');
            Route::get('delete-brand-image/{id?}', 'deleteBrandImage');
            Route::get('delete-brand-logo/{id?}', 'deleteBrandLogo');


        });
    });







    // login
    Route::controller(AdminController::class)->group(function () {
        Route::match(['get', 'post'], 'login', 'login')->name('admin.login');
    });
});
