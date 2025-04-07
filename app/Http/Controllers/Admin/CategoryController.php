<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Taxonomy;
use App\Http\Resources\Admin\TaxonomyResource;

/**
 * Admin Post Category Controller
 */
class CategoryController extends AdminController
{
    /**
     * Display a listing of the post categories.
     */
    public function index()
    {
        $parentTaxonomy = Taxonomy::where('slug', 'post-categories')->first();
        $categories = $parentTaxonomy->children()->paginate(25);

        return view('categories.index', compact('categories'));
    }

    /**
     * Display a listing of the post categories.
     */
    public function childIndex(int $parent_id)
    {
        $parentTaxonomy = Taxonomy::where('parent_id', $parent_id)->first();
        $categories = $parentTaxonomy->children()->paginate(25);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating or editing a post category.
     */
    public function show(int $id)
    {
        $category = Taxonomy::findOrFail($id);

        return new TaxonomyResource($category);
    }

    /**
     * Store or update a post category.
     */
    public function store(Request $request)
    {
        $parentTaxonomy = Taxonomy::where('slug', 'post-categories')->first();

        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:sys_taxonomies,slug,' . $request->id,
        ]);

        $category = Taxonomy::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'parent_id' => $parentTaxonomy->id,
            ]
        );

        $message = $category->wasRecentlyCreated ? 'created' : 'updated';

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success store $message category: " . $category->name
            ]);
        }

        return redirect()->route('posts.categories.index')
            ->with('success', "Success store $message category: " . $category->name);
    }

    /**
     * Delete a post category.
     */
    public function delete(int $id)
    {

        $category = Taxonomy::find($id);

        if (!$category) {
            return redirect()->route('posts.categories.index')
                ->with('failed', 'Category not found.');
        }

        if ($category->delete()) {
            return redirect()->route('posts.categories.index')
                ->with('success', 'Success delete category: ' . $category->title);
        }

        return redirect()->route('posts.categories.index')
            ->with('failed', 'Failed delete category: ' . $category->title);
    }

    /**
     * Remove selected categories.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeSelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:sys_taxonomies,id',
        ]);

        try {
            Taxonomy::whereIn('id', $request->ids)->delete();

            return response()->json([
                'message' => 'Selected categories removed successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Tangani error
            return response()->json([
                'message' => 'An error occurred while removing selected categories.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

