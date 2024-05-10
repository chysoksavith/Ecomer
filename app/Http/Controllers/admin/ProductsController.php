<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\AdminRoles;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductsAttribure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function products(Request $request)
    {
        Session::put('page', 'products');

        // Use paginate here
        $products = Product::with('category', 'images')->get();



        $productsModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'products'])->count();

        $productsModule = array();

        if (Auth::guard('admin')->user()->type == "admin") {
            $productsModule['view_access'] = 1;
            $productsModule['edit_access'] = 1;
            $productsModule['full_access'] = 1;
        } elseif ($productsModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $productsModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'products'])->first()->toArray();
        }

        return view('admin.products.products')->with(compact('products', 'productsModule'));
    }

    // add product
    public function AddUpdateProducts(Request $request, $id = null)
    {
        // get category and their sub category
        $getCategories = Category::getCategories();
        // product filter
        $productsFilters = Product::productsFilters();
        // brands filter
        $getBrands = Brand::where('status', 1)->get()->toArray();

        $product = new Product;
        if ($id == "") {
            $title = "Add Products";
            $productdata  = array();
            $message = ' Product added successfully';
        } else {
            $title = "Edit Products";
            $product = Product::with(['images', 'attributes'])->find($id);
            $message = 'Product update successfully';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;


            // validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'product_code' => 'required|regex:/^[\w-]+$/|max:30',
                'product_price' => ['required', 'integer'],
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
            ];
            $customMessage = [
                'category_id.required' => 'The category is required.',
                'product_name.required' => 'The product name is required.',
                'product_name.regex' => 'The product name should only contain letters, spaces, and hyphens.',
                'product_name.max' => 'The product name should not exceed 255 characters.',
                'product_code.required' => 'The product code is required.',
                'product_code.regex' => 'The product code should only contain letters, numbers, and hyphens.',
                'product_code.max' => 'The product code should not exceed 30 characters.',
                'product_price.required' => 'The product price is required.',
                'product_color.required' => 'The product color is required.',
                'product_color.regex' => 'The product color should only contain letters, spaces, and hyphens.',
                'product_color.max' => 'The product color should not exceed 200 characters.',
               
            ];

            $this->validate($request, $rules, $customMessage);

            // product video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    $videoName = $video_tmp->getClientOriginalName();
                    $videoExtension = $video_tmp->getClientOriginalExtension();
                    $videoName = $videoName . '-' . rand() . '.' . $videoExtension;
                    $videoPath = "front/videos/";
                    $video_tmp->move($videoPath, $videoName);
                    $product->product_video = $videoName;
                }
            }


            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];

            if (!empty($data['product_discount']) && $data['product_discount'] > 0) {
                if (!empty($data['product_discount_type']) && $data['product_discount_type'] == 'fixed') {
                    // Apply fixed discount
                    $product->discount_type = 'product';
                    $product->final_price = $data['product_price'] - $data['product_discount'];
                } else {
                    // Apply percentage discount
                    $product->discount_type = 'product';
                    $product->final_price = $data['product_price'] - ($data['product_price'] * $data['product_discount']) / 100;
                }
            } else {
                $getCategoryDiscount = Category::select('category_discount')->where('id', $data['category_id'])->first();
                if ($getCategoryDiscount->category_discount == 0) {
                    $product->discount_type = "";
                    $product->final_price = $data['product_price'];
                } else {
                    $product->discount_type = 'category';
                    $product->final_price = $data['product_price'] - ($data['product_price'] * $getCategoryDiscount->category_discount) / 100;
                }
            }

            $product->family_color = $data['family_color'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->Search_Keywords = $data['Search_Keywords'];
            $product->group_code = $data['group_code'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_Keywords = $data['meta_Keywords'];
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = "No";
            }
            if (!empty($data['is_bestseller'])) {
                $product->is_bestseller = $data['is_bestseller'];
            } else {
                $product->is_bestseller = "No";
            }
            $product->status = 1;
            $product->save();

            if ($id == "") {
                $product_id = DB::getPdo()->lastInsertId();
            } else {
                $product_id = $id;
            }

            if ($request->hasFile('product_images')) {
                $images = $request->file('product_images');
                foreach ($images as $key => $image) {
                    // Output file information for debugging
                    echo "File Name: " . $image->getClientOriginalName() . "<br>";
                    echo "File Size: " . $image->getSize() . " bytes<br>";

                    $extension = $image->getClientOriginalExtension();
                    $imageName = 'product-' . rand(1111, 9999999) . '.' . $extension;
                    $image->move('front/images/products/', $imageName);

                    $productImage = new ProductImage;
                    $productImage->image = $imageName;
                    $productImage->product_id = $product_id;
                    $productImage->status = 1;
                    $productImage->save();
                }
            }
            // update sort image
            if ($id != "") {
                if (isset($data['image'])) {
                    foreach ($data['image'] as $key => $image) {
                        ProductImage::where(['product_id' => $id, 'image' => $image])->update(['image_sort' => $data['image_sort'][$key]]);
                    }
                }
            }
            // Add Product Attribute
            foreach ($data['size'] as $Key => $value) {
                if (!empty($value)) {
                    // Check if SKU already exists
                    $countSKU = ProductsAttribure::where('sku', $data['sku'][$Key])->count();
                    if ($countSKU > 0) {
                        $message = "SKU Already exists, Please add another SKU";
                        return redirect()->back()->with('error_message', $message);
                    }

                    // Check if Size already exists
                    $countSize = ProductsAttribure::where(['product_id' => $product_id, 'size' => $data['size'][$Key]])->count();
                    if ($countSize > 0) {
                        $message = "Size Already exists, Please add another Size";
                        return redirect()->back()->with('error_message', $message);
                    }

                    $attribute = new ProductsAttribure;
                    $attribute->product_id = $product_id;
                    $attribute->sku = $data['sku'][$Key];
                    $attribute->size = $data['size'][$Key];
                    $attribute->price = $data['price'][$Key];
                    $attribute->stock = $data['stock'][$Key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }


            // Edit Product Attribute
            if (isset($data['attributeId']) && is_array($data['attributeId'])) {
                foreach ($data['attributeId'] as $aKey => $attributeId) {
                    // Ensure $attributeId is not empty
                    if (!empty($attributeId)) {
                        // Find the product attribute by ID
                        $attribute = ProductsAttribure::find($attributeId);

                        // Check if the attribute exists
                        if ($attribute) {
                            // Update price and stock
                            $attribute->price = $data['price'][$aKey];
                            $attribute->stock = $data['stock'][$aKey];
                            $attribute->save();
                        }
                    }
                }
            }





            return redirect('admin/products')->with('success_message', $message);
        }

        return view('admin.products.add_edit_products')->with(compact('title', 'getCategories', 'productsFilters', 'product', 'getBrands'));
    }

















    // update status product
    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->ajax()) {
                $data = $request->all();
                if ($data['status'] == 'Active') {
                    $status = 0;
                } else {
                    $status = 1;
                }
                Product::where('id', $data['product_id'])->update(['status' => $status]);
                return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
            }
        }
    }
    // delete
    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Product deleted Successfully');
    }
    // delete video
    public function deleteProductVideo($id)
    {
        $productVideo = Product::select('product_video')->where('id', $id)->first();
        $product_video_path = "front/videos/";
        if (file_exists($product_video_path . $productVideo->product_video)) {
            unlink($product_video_path . $productVideo->product_video);
        }

        Product::where('id', $id)->update(['product_video' => '']);

        $message = "Product video has been delete successfully";
        return redirect()->back()->with('success_message', $message);
    }
    public function deleteProductImage($id)
    {
        $productImage = ProductImage::select('image')->where('id', $id)->first();
        $image_path = 'front/images/products/';

        if (file_exists($image_path . $productImage->image)) {
            unlink($image_path . $productImage->image);
        }
        ProductImage::where('id', $id)->delete();
        $message = "Product Image have been delete";
        return redirect()->back()->with('success_message', $message);
    }
    // attr
    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->ajax()) {
                $data = $request->all();
                if ($data['status'] == 'Active') {
                    $status = 0;
                } else {
                    $status = 1;
                }
                ProductsAttribure::where('id', $data['attribute_id'])->update(['status' => $status]);
                return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
            }
        }
    }
    public function deleteAttribute($id)
    {
        ProductsAttribure::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Product Attr Successfully');
    }
}
