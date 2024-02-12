<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BannersController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CmsController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\front\ContactUsController;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\front\ProductController;
use App\Http\Controllers\front\UserController;
use App\Models\Category;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::namespace('App\Http\Controllers\front')->group(function () {

    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'index')->name('front.home');
        Route::get('HomePage', 'HomePage')->name('HomePage');
    });
    // Listing Category Routes
    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url');

    foreach ($catUrls as $url) {
        Route::get($url, [ProductController::class, 'listing']);
    }
    // product details
    Route::controller(ProductController::class)->group(function () {
        Route::get('product/{id}', 'detail')->name('front.product.details');
        // get attr price and size
        Route::post('get-attribute-price', 'getAttrPrice');
        // add to cart
        Route::post('/add-to-cart', 'AddtoCarts');
        // Shopping cart
        Route::get('cart', 'cart');
        // update cart
        Route::post('/update-cart-item-qty', 'updateCartQty');

        // delete cart
        Route::post('/delete-cart-item', 'deleteCart');
        // empty cart
        Route::post('/empty-cart', 'emptyCart');
        Route::get('/check-login-status', 'checkLoginStatus');

        // Search
        Route::get('/search', 'search')->name('search');
    });
    // contact us
    Route::controller(ContactUsController::class)->group(function () {
        Route::get('contact-us', 'contactUs')->name('front.contact-us');
    });
    Route::group(['middleware' => ['auth']], function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('user/logout', 'userLogout');
            Route::match(['get', 'post'], 'user/account', 'userAccount')->name('user.account');
            Route::match(['get', 'post'], 'user/update-password', 'updatePassword');
            Route::post('/apply-coupon', [ProductController::class, 'applyCoupon']);
        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::match(['get', 'post'], 'user/login', 'loginUser')->name('login');
        Route::match(['get', 'post'], 'user/register', 'registerUser')->name('user.register');
        Route::match(['get', 'post'], 'user/confirm/{code}', 'confirmAccount');
        Route::match(['get', 'post'], 'user/forgot-password', 'forgotPassword');
        Route::match(['get', 'post'], 'user/reset-password/{code?}', 'resetPassword');
    });
});


//
Route::group(['prefix' => '/admin'], function () {

    Route::group(['middleware' => ['admin']], function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('admin.index');
            Route::get('logout', 'logout')->name('admin.logout');
            // password
            Route::match(['get', 'post'], 'update-password', 'updatePassword')->name('admin.update.password');
            Route::match(['get', 'post'], 'update-detail', 'updateAdminDetail')->name('admin.update.adminDetails');
            Route::post('check-current-password', 'checkCurrentPassword')->name('admin.checkCurrent.password');
            // subadmin
            Route::get('subadmin', 'subadmin')->name('admin.subadmin');
            Route::post('update-subadmin-status', 'SubAdminStatus');
            Route::get('delete-subadmin/{id?}', 'Subadmindestroy');
            Route::match(['get', 'post'], 'add-edit-subadmin/{id?}', 'addedit_subadmin')->name('admin-addedit-subadmin');
            Route::match(['get', 'post'], 'update-role/{id?}', 'updateRoles')->name('admin-updateRoles');
        });
        // Cms pages
        Route::controller(CmsController::class)->group(function () {
            Route::get('cms-pages', 'index')->name('admin.cmspages');
            Route::post('update-cms-pages-status', 'update')->name('admin.cmspages.update');
            Route::match(['get', 'post'], 'add-edit-cms-pages/{id?}', 'edit')->name('admin-addedit-cms-page');
            Route::get('delete-cms-pages/{id?}', 'destroy');
        });
        // Categories
        Route::controller(CategoryController::class)->group(function () {
            Route::get('categories', 'categories')->name('admin.categories');
            Route::post('update-category-status', 'updateCategoryStatus')->name('admin.update.category.status');
            Route::get('delete-category/{id?}', 'deleteCategory');
            Route::get('delete-category-image/{id?}', 'deleteCategoryImage');
            Route::match(['get', 'post'], 'add-edit-category/{id?}', 'AddUpdateCategorys')->name('admin.add.edit.category');
        });
        // Product
        Route::controller(ProductsController::class)->group(function () {
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
        Route::controller(BrandsController::class)->group(function () {
            Route::get('brands', 'brands')->name('admin.brands');
            Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'AddUpdateBrands')->name('admin.add.edit.brand');
            Route::post('update-brand-status', 'updateBrandStatus')->name('admin.update.brand.status');
            Route::get('delete-brand/{id?}', 'deleteBrand');
            Route::get('delete-brand-image/{id?}', 'deleteBrandImage');
            Route::get('delete-brand-logo/{id?}', 'deleteBrandLogo');
        });
        // banners
        Route::controller(BannersController::class)->group(function () {
            Route::get('banners', 'banners')->name('admin.banners');
            Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'AddUpdatebanners')->name('admin.add.edit.banner');
            Route::post('update-banner-status', 'updatebannerstatus')->name('admin.update.banner.status');
            Route::get('delete-banner/{id?}', 'deleteBanner');
            Route::get('delete-banner-image/{id?}', 'deleteBannerImage');
        });
        // coupon
        Route::controller(CouponController::class)->group(function () {
            Route::get('coupons', 'coupon');
            Route::post('update-coupon-status', 'updateCouponStatus');
            Route::get('delete-coupon/{id}',  'deleteCoupon');
            Route::match(['get', 'post'], 'add-edit-coupon/{id?}',  'AddEditCoupon');
        });
    });







    // login
    Route::controller(AdminController::class)->group(function () {
        Route::match(['get', 'post'], 'login', 'login')->name('admin.login');
    });
});
