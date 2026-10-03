<?php

namespace App\Http\Controllers\Frontend;

use App\Models\SiteContent;

class HomeController extends Controller
{
    public function index()
    {
        $cms = SiteContent::allKeyed();
        return view('website.index', compact('cms'));
    }
}
