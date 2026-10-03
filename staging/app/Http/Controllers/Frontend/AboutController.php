<?php

namespace App\Http\Controllers\Frontend;

use App\Models\SiteContent;

class AboutController extends Controller
{
    public function index()
    {
        $cms = SiteContent::allKeyed();
        return view('website.about', compact('cms'));
    }
}
