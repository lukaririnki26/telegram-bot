<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tags;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\TagsResource;

/**
 * Admin Post Tag Controller
 */
class TagController extends AdminController
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $tags = Tags::paginate(50);

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating or editing a post.
     */
    public function show(int $id)
    {
        $tag = Tags::findOrFail($id);

        return new TagsResource($tag);
    }

    /**
     * Store or update a post.
     */
    public function store(Request $request)
    {
        $request->offsetSet('record_type', 'POST');

        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:sys_tags,slug,' . $request->id,
        ]);

        $tag = Tags::updateOrCreate(
            ['id' => $request->id],
            $request->only([
                'name',
                'slug',
                'description',
            ])
        );

        $message = $tag->wasRecentlyCreated ? 'created' : 'updated';

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success store $message tag: " . $tag->name
            ]);
        }

        return redirect()->route('posts.tags.index')
            ->with('success', "Success store $message tag: " . $tag->name);
    }

    /**
     * Delete a post.
     */
    public function delete(int $id)
    {

        $tag = Tags::find($id);

        if (!$tag) {
            return redirect()->route('posts.index')
                ->with('failed', 'Tag not found.');
        }

        if ($tag->delete()) {
            return redirect()->route('posts.index')
                ->with('success', 'Success delete tag: ' . $tag->title);
        }

        return redirect()->route('posts.index')
            ->with('failed', 'Failed delete tag: ' . $tag->title);
    }

    /**
     * Remove selected tags.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeSelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:sys_tags,id',
        ]);

        try {
            Tags::whereIn('id', $request->ids)->delete();

            return response()->json([
                'message' => 'Selected tags removed successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Tangani error
            return response()->json([
                'message' => 'An error occurred while removing selected tags.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

