<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function products(Request $request)
    {
        Session::put('page', 'products');
        $products = Product::latest()->paginate(10);

        if ($request->get('Keyword')) {
            $products = $products->where('product_name', 'like', '%' . $request->Keyword . '%');
        }
        return view('admin.products.products',)->with(compact('products'));
    }
    // add product
    public function AddUpdateProducts(Request $request, $id = null)
    {
        // get category and their sub category
        $getCategories = Category::getCategories();
        // product filter
        $productsFilters = Product::productsFilters();
        $product = new Product;
        if ($id == "") {
            $title = "Add Products";
            $productdata  = array();
            $message = ' Product added successfully';
        } else {
            $title = "Edit Products";
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
                'family_color' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
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
                'family_color.required' => 'The family color is required.',
                'family_color.regex' => 'The family color should only contain letters, spaces, and hyphens.',
                'family_color.max' => 'The family color should not exceed 200 characters.',
            ];

            $this->validate($request, $rules, $customMessage);
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
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
                $product_is_featured = "No";
            }
            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success_message', $message);
        }

        return view('admin.products.add_edit_products')->with(compact('title', 'getCategories', 'productsFilters'));
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
        Product::where('id', $id);
        return redirect()->back()->with('success_message', 'Product deleted Successfully');
    }
}