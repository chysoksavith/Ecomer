<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BannersController extends Controller
{
    public function banners(Request $request)
    {
        Session::put('pages', 'banners');
        $banners = Banners::latest('id');
        if ($request->has('Keyword')) {
            $keyword = $request->input('Keyword');
            $banners->where('id', $keyword);
        }
        $banners = $banners->paginate(10);
        $bannersModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'banners'])->count();

        $bannersModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $bannersModule['view_access'] = 1;
            $bannersModule['edit_access'] = 1;
            $bannersModule['full_access'] = 1;
        } else if ($bannersModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $bannersModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'banners'])->first()->toArray();
        }
        return view('admin.banners.banner')->with(compact('banners'));
    }


    public function AddUpdatebanners(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Banner";
            $banner = new Banners;
            $message = "Brand added successfully";
        } else {
            $title = "update Banner";
            $banner = Banners::find($id);
            $message = "Banner update successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($id == "") {
                $rules = [
                    'type' => 'required',
                    'image' => 'required',
                ];
            } else {
                $rules = [
                    'type' => 'required',
                    'image' => 'required'
                ];
            }
            $customMessage = [
                'image' => 'image required',
                'type' => 'Banner type required',
            ];

            $this->validate($request, $rules, $customMessage);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'front/images/banner/' . $imageName;
                $image->move(public_path('front/images/banner'), $imageName);
                $banner->image = $imageName;
            } else {
                $banner->image = "";
            }

            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->link = $data['link'];
            $banner->sort = $data['sort'];
            $banner->type = $data['type'];
            $banner->save();
            return redirect('admin/banners')->with('success_message', $message);
        }
        return view('admin.banners.add_edit_banner')->with(compact('title', 'banner'));
    }



    public function updatebannerstatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Banners::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }
    public function deleteBanner($id)
    {
        $banners = Banners::where('id', $id)->get();

        foreach ($banners as $banner) {
            // Get the image path
            $bannerImagePath = public_path('front/images/banner') . '/' . $banner->image;

            // Check if the file exists before attempting to delete
            if (file_exists($bannerImagePath)) {
                unlink($bannerImagePath);
            }
        }

        // Delete all records with the given id
        Banners::where('id', $id)->delete();

        return redirect()->back()->with('success_message', 'Delete Banners successfully');
    }

    public function deleteBannerImage($id)
    {
        $banner = Banners::find($id);

        if ($banner) {
            // Get the image path
            $bannerImagePath = public_path('front/images/banner') . '/' . $banner->image;

            // Check if the file exists before attempting to delete
            if (file_exists($bannerImagePath)) {
                unlink($bannerImagePath);
            }

            // Update the database to remove the image reference
            $banner->update(['image' => null]);

            return redirect()->back()->with('success_message', 'Banner Image Deleted Successfully');
        }

        return redirect()->back()->with('error_message', 'Banner not found');
    }
}
