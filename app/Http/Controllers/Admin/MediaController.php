<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Helpers\MediaUploader;
use App\Http\Resources\Admin\MediaResource;

/**
 * Admin Post Media Controller
 */
class MediaController extends AdminController
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $medias = Media::paginate(50);

        return view('medias.index', compact('medias'));
    }

    /**
     * Show the form for creating or editing a post.
     */
    public function show(int $id)
    {
        $media = Media::findOrFail($id);

        return new MediaResource($media);
    }

    /**
     * Store or update a post.
     */
    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required_if:id,null|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,mp3,wav,mp4,mov,avi|max:10240',
            'name' => 'required',
        ]);
        $media =  Media::find($request->id);

        if($request->hasFile('file')){
            if($request->id){
                app(MediaUploader::class)
                    ->fromFile($request->file('file'))
                    ->setMedia($media)
                    ->setRole('file')
                    ->setName($request->name)
                    ->upload();
            }else{
                app(MediaUploader::class)
                    ->fromFile($request->file('file'))
                    ->setRole('file')
                    ->setName($request->name)
                    ->upload();
            }

        }else{
            $media->update([
                'name' => $request->name
            ]);
        }

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success store media"
            ]);
        }

        return redirect()->route('posts.medias.index')
            ->with('success', "Success store media");
    }

    /**
     * Delete a post.
     */
    public function delete(int $id)
    {

        $media = Media::find($id);

        if (!$media) {
            return redirect()->route('posts.index')
                ->with('failed', 'Media not found.');
        }

        if ($media->delete()) {
            return redirect()->route('posts.index')
                ->with('success', 'Success delete media: ' . $media->title);
        }

        return redirect()->route('posts.index')
            ->with('failed', 'Failed delete media: ' . $media->title);
    }

    /**
     * Remove selected medias.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeSelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:sys_medias,id',
        ]);

        try {
            Media::whereIn('id', $request->ids)->delete();

            return response()->json([
                'message' => 'Selected medias removed successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Tangani error
            return response()->json([
                'message' => 'An error occurred while removing selected medias.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

