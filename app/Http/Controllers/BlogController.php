<?php

namespace Fadvi\Http\Controllers;

use Illuminate\Http\Request;

use Fadvi\Blog;

class BlogController extends Controller
{
    public function getBlog()
    {
    	// Retrieve all blog posts
        $blogs = Blog::all();

    	return view('blog.main')->with([
            'blogs' => $blogs,
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
