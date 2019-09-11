<?php

namespace Fadvi\Http\Controllers;

use Illuminate\Http\Request;

use Fadvi\Blog;
use Fadvi\Topic;

use DB;

class BlogController extends Controller
{
    public function getBlog()
    {
    	// Retrieve all blog posts
        $blogs = Blog::all()->sortByDesc('created_at');

        // Retrieve collection of topic names from database table
        $topics = DB::table('topics')->where('life_event', null)->get();
        // Retrieve collection of life event names from database table
        $life_events = DB::table('topics')->where('life_event', 1)->get();

    	return view('blog.main')->with([
            'blogs' => $blogs,
            'topics' => $topics,
            'life_events' => $life_events,
        ]);
    }

    public function getBlogPost($id, $title)
    {
    	$blog = Blog::where('id', $id)->first();

    	return view('blog.post')->with([
    		'blog' => $blog,
    	]);
    }
}
