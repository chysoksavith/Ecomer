<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CmsPagesController extends Controller
{
    public function CmsPage()
    {
        $currentRoute = request()->path();
        $cmsRoutes = CmsPage::where('status', 1)->pluck('url')->toArray();

        if (in_array($currentRoute, $cmsRoutes)) {
            $cmsPageDetails = CmsPage::where('url', $currentRoute)->first()->toArray();
            return view('client.pages.cms_pages')->with(compact('cmsPageDetails'));
        } else {
            abort(404);
        }
    }
}
