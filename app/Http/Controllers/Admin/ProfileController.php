<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\MediaUploader;
use Illuminate\Support\Facades\Hash;

/**
 * Admin Profile Controller
 */
class ProfileController extends AdminController
{

    public function index()
    {
        $user = auth()->user();

        return view('profile.index', compact('user'));
    }

    public function secuitySettingsIndex()
    {
        $user = auth()->user();

        return view('profile.security-settings', compact('user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $validated =  $request->validate([
            'name' => 'required|string',
            'msisdn' => 'required|string|unique:sys_users,msisdn,' . $user->id,
        ]);
        $user->update($validated);
        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success update profile"
            ]);
        }

        return redirect()->route('profile.index')
            ->with('success', "Success update profile");

    }


    public function secuitySettingsStore(Request $request)
    {
        $user = auth()->user();
        $validated =  $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);

        // Check if the current password matches
        if (!Hash::check($validated['current_password'], $user->password)) {
            if($request->expectsJson()){
                return response()->json([
                    'message'  => "Current password unmatched"
                ], 403);
            }

            return redirect()->route('profile.security-settings.index')
                ->with('error', "Current password unmatched");
        }
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success update password"
            ]);
        }

        return redirect()->route('profile.security-settings.index')
            ->with('success', "Success update password");

    }


    public function changeLanguage(Request $request)
    {
        $user = auth()->user();
        $validated =  $request->validate([
            'language' => 'required|string',
        ]);
        $user->update($validated);

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success update language"
            ]);
        }

    }

    public function changeAvatar(Request $request)
    {
        $user = auth()->user();
        $validated =  $request->validate([
            'avatar' => 'required|image',
        ]);
        if($request->hasFile('avatar')){
            app(MediaUploader::class)
                    ->fromFile($request->file('avatar'))
                    ->setEntity($user)
                    ->setRole('avatar')
                    ->upload();
        }

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success update avatar"
            ]);
        }
    }
}
