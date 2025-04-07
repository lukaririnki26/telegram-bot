<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Bot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\Admin\BotResource;
use App\Http\Controllers\Admin\AdminController;

/**
 * Admin Bot Controller
 */
class BotController extends AdminController
{
    /**
     * Display a listing of the taxonomies.
     */
    public function index()
    {
        $bots = Bot::paginate(25);

        return view('bots.index', compact('bots'));
    }

    /**
     * Show the form for creating or editing a bot.
     */
    public function show(int $id)
    {
        $bot = Bot::findOrFail($id);

        return new BotResource($bot);
    }

    /**
     * Store or update a bot.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'username' => [
                'required',
                Rule::unique('bots', 'username')->ignore($request->id)
            ],
            'token' => [
                'required',
                Rule::unique('bots', 'token')->ignore($request->id)
            ]
        ]);
        $bot = Bot::updateOrCreate(
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
                'message'  => "Success store $message bot: " . $bot->name
            ]);
        }

        return redirect()->route('settings.bots.index')
            ->with('success', "Success store $message bot: " . $bot->name);
    }

    /**
     * Delete a bot.
     */
    public function delete(int $id)
    {

        $bot = Bot::find($id);

        if (!$bot) {
            return redirect()->route('settings.bots.index')
                ->with('failed', 'Tag not found.');
        }

        if ($bot->delete()) {
            return redirect()->route('settings.bots.index')
                ->with('success', 'Success delete bot: ' . $bot->title);
        }

        return redirect()->route('posts.index')
            ->with('failed', 'Failed delete bot: ' . $bot->title);
    }

    /**
     * Remove selected taxonomies.
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
            Bot::whereIn('id', $request->ids)->delete();

            return response()->json([
                'message' => 'Selected bots removed successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while removing selected bots.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

