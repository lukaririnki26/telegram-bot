<?php

namespace App\Http\Controllers\Site;

use App\Models\Posts;

/**
 * Class Post
 */
class PageController extends SiteController
{
    public function show(string $slug)
    {
        if($page = Posts::where([
            'slug' => $slug,
            'record_type' => 'PAGE',
            'record_status' => 'PUBLISH'
        ])->first()) {
            if($page->record_visibility === 'PUBLIC') {
                return view('page', compact('page'));
            }
        }

        abort(404);
    }
}
