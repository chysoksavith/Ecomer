<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDO;

class LogoController extends Controller
{
    public function logoList()
    {
        Session::put('page', 'logo');

        $getRecord = LogoModel::get_record();
        return view('admin.logo.list')->with(compact('getRecord'));
    }
    public function logo_add(Request $request)
    {

        return view('admin.logo.add');
    }
    public function logo_insert(Request $request)
    {
        $insert = new LogoModel;
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'admin/images/logo/' . $imageName;
            $image->move(public_path('admin/images/logo'), $imageName);
            $insert->logo = $imageName;
        }
        $insert->save();
        return redirect('admin/logo-list')->with('success_message', 'Record successfully added');
    }
    public function logo_updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == 'Active') ? 0 : 1;

            LogoModel::where('id', $data['logo_id'])->update(['status' => $status]);

            return response()->json([
                'status' => $status,
                'logo_id' => $data['logo_id']
            ]);
        }
    }
    public function logo_edit(Request $request, $id)
    {
        $getSingle = LogoModel::get_single($id);
        return view('admin.logo.edit')->with(compact('getSingle'));
    }
    public function logo_update(Request $request, $id)
    {
        $update = LogoModel::get_single($id);
        if (!$update) {
            return redirect('admin/logo-list')->with('error', 'Record not found');
        }
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);
        if ($request->hasFile('logo')) {
            if (!empty($update->logo) && file_exists(public_path('admin/images/logo/' . $update->logo))) {
                unlink(public_path('admin/images/logo/' . $update->logo));
            }

            $file = $request->file('logo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/images/logo'), $fileName);
            $update->logo = $fileName;
        }

        $update->save();
        return redirect('admin/logo-list')->with('success_message', 'Record successfully updated');
    }

    public function logo_delete(Request $request, $id)
    {
        // Find the record by its ID
        $record = LogoModel::find($id);

        if (!$record) {
            return redirect()->back()->with('error_message', "Record not found");
        }

        // Check if the logo attribute is not empty
        if (!empty($record->logo)) {
            // Construct the full path to the image file
            $deletePath = 'admin/images/logo/';
            $imagePath = $deletePath . $record->logo;

            // Check if the constructed path points to a file and delete it if it exists
            if (file_exists($imagePath)) {
                if (is_file($imagePath)) {
                    unlink($imagePath);
                } else {
                    return redirect()->back()->with('error_message', "The path is not a file: $imagePath");
                }
            } else {
                return redirect()->back()->with('error_message', "File does not exist: $imagePath");
            }
        }

        // Delete the record from the database
        $record->delete();

        return redirect()->back()->with('success_message', "Record and associated image deleted successfully");
    }
}
