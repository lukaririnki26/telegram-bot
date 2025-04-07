<?php

namespace App\Http\Controllers\Admin;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Helpers\MediaUploader;

/**
 * Admin Posts Controller
 */
class PostController extends AdminController
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Posts::where('record_type', 'POST')->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating or editing a post.
     */
    public function form(int $id = null)
    {
        $post = $id ? Posts::find($id) : null;

        return view('posts.form', compact('post'));
    }

    /**
     * Store or update a post.
     */
    public function store(Request $request)
    {
        $request->offsetSet('record_type', 'POST');

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:sys_posts,slug,' . $request->id,
            'content' => 'required',
            'record_visibility' => 'required|in:PUBLIC,READONLY,PROTECTED,PRIVATE,MEMBER_ONLY',
        ]);

        $post = Posts::updateOrCreate(
            ['id' => $request->id],
            $request->only([
                'lang', 'title', 'slug', 'excerpt', 'content', 'metadata',
                'settings', 'start_publish', 'end_publish', 'record_visibility',
                'record_type', 'parent_id', 'record_status'
            ])
        );

        if($request->hasFile('featured_image')){
            app(MediaUploader::class)
                    ->fromFile($request->file('featured_image'))
                    ->setEntity($post)
                    ->setRole('featured_image')
                    ->upload();
        }

        $message = $post->wasRecentlyCreated ? 'created' : 'updated';

        return redirect()->route('posts.index')
            ->with('success', "Success $message post: " . $post->title);
    }

    /**
     * Delete a post.
     */
    public function delete(int $id)
    {
        $post = Posts::find($id);

        if (!$post) {
            return redirect()->route('posts.index')
                ->with('failed', 'Post not found.');
        }

        if ($post->delete()) {
            return redirect()->route('posts.index')
                ->with('success', 'Success delete post: ' . $post->title);
        }

        return redirect()->route('posts.index')
            ->with('failed', 'Failed delete post: ' . $post->title);
    }
}
