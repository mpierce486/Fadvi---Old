<?php

namespace Fadvi\Http\Controllers;

use Fadvi\Advisor;

use Illuminate\Http\Request;

class AdvisorController extends Controller
{
    public function getAdvisors()
    {
    	$advisors = Advisor::all();
    	
    	return view('advisors.advisors')->with([
    		'advisors' => $advisors,
    	]);
    }


}
