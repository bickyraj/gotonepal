<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuItem;
use Illuminate\Http\Request;
use App\Page;
use TOC\MarkupFixer;
use TOC\TocGenerator;

class PageController extends Controller
{
	// public function about()
	// {
	// 	$page = Page::where('slug', '=', 'about-us')->first();

	// 	if ($page) {
	// 		return view('front.pages.about', compact('page'));
	// 	}

	// 	return abort(404);
	// }

	public function show($slug)
	{
		$page = Page::where('slug', '=', $slug)->first();

		if ($page) {
			$about_menu = Menu::where('name', '=', 'about-us')->first();

			if ($about_menu) {
				$menu = MenuItem::where('menu_id', '=', $about_menu->id)->with('children')->where('parent_id', '=', null)->get();
			}

			if (
				$page->slug === 'nepal-travel-guide'
				|| $page->slug === 'tibet-travel-guide'
				|| $page->slug === 'bhutan-travel-guide'
				|| $page->slug === 'india-travel-guide'
			) {
				$markupFixer  = new MarkupFixer();
				$tocGenerator = new TocGenerator();
				$body = $markupFixer->fix($page->description, 2, 1);
				$contents = $tocGenerator->getHTMLMenu($body, 2, 1);
			} else {
				$body = "";
				$contents = "";
			}

			return view('front.pages.show', compact('page', 'menu', 'body', 'contents'));
		}

		return abort(404);
	}
}
