<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ColorController extends Controller
{
    public function getColor()
    {
        Session::put('page', 'colors');
        $colors = Color::get();
        // permission
        $colorModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'colors'])->count();

        $colorsModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $colorsModule['view_access'] = 1;
            $colorsModule['edit_access'] = 1;
            $colorsModule['full_access'] = 1;
        } else if ($colorModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $colorsModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'colors'])->first()->toArray();
        }
        return view('admin.colors.color')->with(compact('colors', 'colorsModule'));
    }
    public function addEditColor(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Color";
            $color = new Color;
            $message = "Color Added successfully";
        } else {
            $title = "Update Color";
            $color = Color::find($id);
            if (!$color) {
                return redirect('admin/colors')->with('error_message', 'Color not found');
            }
            $message = "Color Updated successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $color->color_name = $data['color_name'];
            $color->color_code = $data['color_code'];
            $color->status = 1;
            $color->save();

            return redirect('admin/colors')->with('success_message', $message);
        }

        return view('admin.colors.add_edit_color')->with(compact('color', 'title'));
    }
    public function updateColorStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Color::where('id', $data['color_id'])->update(['status' => $status]);
            return response()->json([
                'status' => $status,
                'color_id' => $data['color_id']
            ]);
        }
    }
    public function deleteColor($id)
    {
        Color::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Delete Color successfully');
    }
}
