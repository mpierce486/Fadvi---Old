<?php

namespace Fadvi\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function getSitemap()
    {
    	return view('sitemap');
    }
}
