<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrandsController extends Controller
{
    public function brands(Request $request)
    {
        Session::put('page', 'brands');
        $brands = Brand::get();
        // Paginate the results
        $brandsModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'brands'])->count();

        $brandsModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $brandsModule['view_access'] = 1;
            $brandsModule['edit_access'] = 1;
            $brandsModule['full_access'] = 1;
        } else if ($brandsModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $brandsModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'brands'])->first()->toArray();
        }

        return view('admin.brands.brands')->with(compact('brands', 'brandsModule'));
    }
    public function AddUpdateBrands(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Brands";
            $brand = new Brand;
            $message = "Brands added successfully";
        } else {
            $title = "Update Brands";
            $brand = Brand::find($id);
            $message = "Brands update successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($id == "") {
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required|unique:brands',
                ];
            } else {
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required',
                ];
            }
            $customMessage = [
                'brand_name,required' => 'Brand Name is required',
                'url.required' => 'Brand URL is required',
                'url.unique' => 'Unique Brand URL is required',
            ];

            $this->validate($request, $rules, $customMessage);

            if ($request->hasFile('brand_image')) {
                $image = $request->file('brand_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'front/images/brands/' . $imageName;
                $image->move(public_path('front/images/brands'), $imageName);
                $brand->brand_image = $imageName;
            } else {
                $brand->brand_image = "";
            }
            if ($request->hasFile('brand_logo')) {
                $image = $request->file('brand_logo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'front/images/brandsLogo/' . $imageName;
                $image->move(public_path('front/images/brandsLogo'), $imageName);
                $brand->brand_logo = $imageName;
            } else {
                $brand->brand_logo = "";
            }
            if (empty($data['brand_discount'])) {
                $data['brand_discount'] = 0;
                if ($id != "") {
                    $brandProducts = Product::where('brand_id', $id)->get()->toArray();
                    foreach ($brandProducts as $Key => $product) {
                        if ($product['discount_type'] == "brand") {
                            Product::where('id', $product['id'])->update(['discount_type' == '', 'final_price' == $product['product_price']]);
                        }
                    }
                }
            }
            $brand->brand_name = $data['brand_name'];
            $brand->brand_discount = $data['brand_discount'];
            $brand->description = $data['description'];
            $brand->url = $data['url'];
            $brand->meta_title = $data['meta_title'];
            $brand->meta_description = $data['meta_description'];
            $brand->meta_Keywords = $data['meta_Keywords'];
            $brand->status = 1;
            $brand->save();

            return redirect('admin/brands')->with('success_message', $message);
        }

        return view('admin.brands.add_edit_brands')->with(compact('brand', 'title'));
    }

    // delte
    public function deleteBrand($id)
    {
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Delete Brand success');
    }
    // update status
    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
    public function deleteBrandImage($id)
    {
        $brandImage = Brand::select('brand_image')->where('id', $id)->first();
        $brandImagePath = 'front/images/brands/';

        if (file_exists($brandImagePath . $brandImage->brand_image)) {
            unlink($brandImagePath . $brandImage->brand_image);
        }

        Brand::where('id', $id)->update(['brand_image' => '']);
        return redirect()->back()->with('success_message', "Brand Image deleted successfully");
    }

    public function deleteBrandLogo($id)
    {
        $brandLogo = Brand::select('brand_logo')->where('id', $id)->first();
        $brandLogoPath = 'front/images/brandsLogo/';

        if (file_exists($brandLogoPath . $brandLogo->brand_logo)) {
            unlink($brandLogoPath . $brandLogo->brand_logo);
        }

        Brand::where('id', $id)->update(['brand_logo' => '']);
        return redirect()->back()->with('success_message', "Brand Logo deleted successfully");
    }
}
