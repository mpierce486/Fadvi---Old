<?php

namespace Fadvi\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getTerms()
    {
    	return view('terms');
    }

    public function getPrivacy()
    {
    	return view('privacy');
    }

    public function getWhy()
    {
    	return view('why');
    }
}
