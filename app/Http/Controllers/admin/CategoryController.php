<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categories(Request $request)
    {
        Session::put('page', 'categories');
        $categories = Category::with('parentCategory')->latest('id');

        if ($request->get('Keyword')) {
            $categories = $categories->where('category_name', 'like', '%' . $request->Keyword . '%');
        }
        $categories = $categories->paginate(10);
        // set admin/subadmin permissions for Category
        $categoriesModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'categories'])->count();

        $categoriesModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $categoriesModule['view_access'] = 1;
            $categoriesModule['edit_access'] = 1;
            $categoriesModule['full_access'] = 1;
        } else if ($categoriesModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $categoriesModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'categories'])->first()->toArray();
        }
        return view('admin.categories.categories')->with(compact('categories', 'categoriesModule'));
    }

    // update status
    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }
    public function AddUpdateCategorys(Request $request, $id = null)
    {
        $getCategories = Category::getCategories();
        if ($id == "") {
            $title = "Add Category";
            $category = new Category;
            $message = "Category add successfully";
        } else {
            $title = "Edit Category";
            $category = Category::find($id);
            $message = "Category update successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();


            if ($id == "") {
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required|unique:categories',
                ];
            } else {
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required',
                ];
            }

            $customMessages = [
                'category_name.required' => 'Category Name is required',
                'url.required' => 'Category URL is required',
                'url.unique' => 'Unique Category URL is required',

            ];

            // The validate method automatically redirects back with errors if validation fails
            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'admin/images/category/' . $imageName;
                $image->move(public_path('admin/images/category'), $imageName);
                $category->category_image = $imageName;
            } else {
                $category->category_image = "";
            }
            if (empty($data['category_discount'])) {
                $data['category_discount'] = 0;
            }

            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_Keywords = $data['meta_Keywords'];
            $category->status = 1;
            $category->save();

            return redirect('admin/categories')->with('success_message', $message);
        }


        return view('admin.categories.add_edit_category')->with(compact('title', 'getCategories', 'category'));
    }
    // delete category
    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'delete category success');
    }
    // delete image category
    public function deleteCategoryImage($id)
    {
        $categoryImage = Category::select('category_image')->where('id', $id)->first();
        $category_image_path = 'admin/images/category/';
        if (file_exists($category_image_path . $categoryImage->category_image)) {
            unlink($category_image_path . $categoryImage->category_image);
        }
        Category::where('id', $id)->update(['category_image' => '']);
        return redirect()->back()->with('success_message', 'Category image delete successfully');
    }
}
