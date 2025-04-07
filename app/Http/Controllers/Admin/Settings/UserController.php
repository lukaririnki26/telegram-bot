<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\MediaUploader;
use App\Http\Resources\Admin\UserResource;
use App\Http\Controllers\Admin\AdminController;

/**
 * Admin Post User Controller
 */
class UserController extends AdminController
{
    /**
     * Display a listing of the posts.
     */
    public function index(Request $request)
    {
        $users = User::paginate(50);

        if($request->expectsJson()){
            return UserResource::collection($users);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating or editing a post.
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Store or update a post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image',
            'name' => 'required|string',
            'email' => 'required|unique:sys_users,email,' . $request->id,
            'msisdn' => 'required|unique:sys_users,msisdn,' . $request->id,
        ]);

        $user = User::updateOrCreate(
            ['id' => $request->id],
            $request->only([
                'name',
                'email',
                'msisdn',
            ])
        );

        if($request->hasFile('avatar')){
            app(MediaUploader::class)
                    ->fromFile($request->file('avatar'))
                    ->setEntity($user)
                    ->setRole('avatar')
                    ->upload();
        }

        $message = $user->wasRecentlyCreated ? 'created' : 'updated';

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success store $message user: " . $user->name
            ]);
        }

        return redirect()->route('settings.users.index')
            ->with('success', "Success store $message user: " . $user->name);
    }

    /**
     * Delete a post.
     */
    public function delete(int $id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('settings.users.index')
                ->with('failed', 'User not found.');
        }

        if ($user->delete()) {
            return redirect()->route('settings.users.index')
                ->with('success', 'Success delete user: ' . $user->title);
        }

        return redirect()->route('settings.users.index')
            ->with('failed', 'Failed delete user: ' . $user->title);
    }

    /**
     * Remove selected users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeSelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:sys_users,id',
        ]);

        try {
            User::whereIn('id', $request->ids)->delete();

            return response()->json([
                'message' => 'Selected users removed successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Tangani error
            return response()->json([
                'message' => 'An error occurred while removing selected users.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

