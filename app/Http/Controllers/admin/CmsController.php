<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Session::put('page', 'cms-pages');
        $CmsPage = CmsPage::latest('id');

        if ($request->get('Keyword')) {
            $CmsPage = $CmsPage->where('title', 'like', '%' . $request->Keyword . '%');
        }

        $CmsPage = $CmsPage->paginate(10);

        return view('admin.pages.cms_pages', compact('CmsPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id = null)
    {
        Session::put('page', 'cms-pages');

        if ($id == "") {
            $title = "Add CMS Page";
            $cmsPage = new CmsPage;
            $message = "CMS Page added successfully";
        } else {
            $title = "Edit CMS Page";
            $cmsPage = CmsPage::find($id);
            $message = "CMS Page updated successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'title' => 'required',
                'url' => 'required',
                'description' => 'required',
            ];
            $customMessage = [
                'title.required' => 'Page Title Required',
                'url.required' => 'Page Url Required',
                'description.required' => 'Page Description Required',
            ];
            $this->validate($request, $rules, $customMessage);
            $cmsPage->title = $data['title'];
            $cmsPage->url = $data['url'];
            $cmsPage->description = $data['description'];
            $cmsPage->meta_title = $data['meta_title'];
            $cmsPage->meta_description = $data['meta_description'];
            $cmsPage->meta_keywords = $data['title'];
            $cmsPage->status = 1;
            $cmsPage->save();
            return redirect(route('admin.cmspages'))->with('success_message', $message);
        }
        return view('admin.pages.add_edit_cmspage')->with(compact('cmsPage', 'title'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'page_id' => $data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::where('id',$id)->delete();
        return redirect()->back()->with('success_message', 'Cms Page Delete Success');
    }
}
