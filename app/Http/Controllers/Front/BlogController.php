<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bickyraj\Toc\Contents;
use App\Blog;

class BlogController extends Controller
{
	public function index()
	{
		$blogs = Blog::latest()->get();
		return view('front.blogs.index', compact('blogs'));
	}

	public function show($slug, Contents $contents)
	{
		$blog = Blog::where('slug', '=', $slug)->with('similar_blogs')->first();
        if ($blog->toc != "") {
            $contents->fromText($blog->toc)->setTags(['h2', 'h3', 'h4'])->setMinLength(100);
            $body = $contents->getHandledText();
            $contents = $contents->getContents();
        } else {
            $body = "";
            $contents = [];
        }

		$blogs = Blog::limit(3)->latest()->get();
		return view('front.blogs.show', compact('blog', 'blogs', 'contents', 'body'));
	}
}
