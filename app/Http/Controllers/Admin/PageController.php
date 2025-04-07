<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use Illuminate\Http\Request;

/**
 * Pages Admin Controller Class
 */
class PageController extends AdminController
{
    public function index()
    {
        $pages = Pages::where('record_type', 'PAGE')->paginate(10);

        return view('pages.index', compact('pages'));
    }

    public function form()
    {
        return view('posts.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        if (empty($request->id)) {
            Pages::create($request->all());

            return redirect()->route('posts.index')
                ->with('success', 'Success create a new page: '.$request->offsetGet('title'));
        } else {
            Pages::find($request->id)->update($request->all());

            return redirect()->route('posts.index')
                ->with('success', 'Success update page: '.$request->offsetGet('title'));
        }
    }

    public function delete(int $id)
    {
        $page = Pages::find($id);

        if ($page->delete()) {
            return redirect()->route('pages.index')
                ->with('success', 'Success delete page: '.$page->title);
        }

        return redirect()->route('pages.index')
            ->with('failed', 'Failed delete page: '.$page->title);
    }
}
