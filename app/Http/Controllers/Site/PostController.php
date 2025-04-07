<?php

namespace App\Http\Controllers\Site;

use App\Http\Resources\Site\PostResource;
use App\Models\Posts;
use Illuminate\Http\Request;

/**
 * Class Post
 */
class PostController extends SiteController
{
    /**
     * Post Index
     */
    public function index(Request $request)
    {
        $posts = Posts::where([
            'record_type' => 'POST',
            'record_status' => 'PUBLISH',
            'record_visibility' => 'PUBLIC'
        ])->simplePaginate(3);

        if ($request->expectsJson()) {
            return PostResource::collection($posts);
        }

        return view('posts.index', compact('posts'));
    }

    public function show(Request $request, string $slug)
    {
        if($post = Posts::where([
            'slug' => $slug,
            'record_type' => 'POST',
            'record_status' => 'PUBLISH'
        ])->first()) {
            if($post->record_visibility === 'PUBLIC') {
                if ($request->expectsJson()) {
                    return new PostResource($post);
                }
                return view('posts.show', compact('post'));
            }
        }

        abort(404);
    }
}
