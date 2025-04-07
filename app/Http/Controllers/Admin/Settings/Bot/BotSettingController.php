<?php

namespace App\Http\Controllers\Admin\Settings\Bot;

use App\Models\Bot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\Admin\Bot\BotSettingResource;
use App\Http\Controllers\Admin\AdminController;

/**
 * Admin BotSetting Controller
 */
class BotSettingController extends AdminController
{

    /**
     * Show the form for creating or editing a setting.
     */
    public function form(int $id)
    {
        $bot = Bot::findOrFail($id);

        return view('bots.setting', compact('bot'));
    }
    /**
     * Store or update a setting.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
        ]);
        
        $setting = Bot::updateOrCreate(
            ['id' => $request->id],
            [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'username' => $request->username,
            'token' => $request->token
            ]
        );

        $message = $request->id == null ? 'created' : 'updated';

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success store $message setting: " . $setting->name
            ]);
        }

        return redirect()->route('settings.bots.settings.index')
            ->with('success', "Success store $message setting: " . $setting->name);
    }
}

