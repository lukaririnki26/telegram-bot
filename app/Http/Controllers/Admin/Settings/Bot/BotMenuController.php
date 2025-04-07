<?php

namespace App\Http\Controllers\Admin\Settings\Bot;

use App\Models\Bot;
use App\Models\BotMenu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\Admin\Bot\BotMenuResource;
use App\Http\Controllers\Admin\AdminController;

/**
 * Admin BotMenu Controller
 */
class BotMenuController extends AdminController
{
    /**
     * Display a listing of the taxonomies.
     */
    public function index(int $bot_id)
    {
        $bot = Bot::findOrFail($bot_id);
        $menus = BotMenu::query()
            ->where('bot_id', $bot_id)
            ->paginate(25);

        return view('bots.menus.index', compact('bot', 'menus'));
    }

    /**
     * Show the form for creating or editing a menu.
     */
    public function show(int $bot_id, int $id)
    {
        $menu = BotMenu::findOrFail($id);

        return new BotMenuResource($menu);
    }
    
    private function checkMenuCommand(string $command, Bot $bot){
        return $bot->menus()->where('command', $command)->exists();
    }
    /**
     * Store or update a menu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'username' => [
                'required',
                Rule::unique('menus', 'username')->ignore($request->id)
            ],
            'token' => [
                'required',
                Rule::unique('menus', 'token')->ignore($request->id)
            ]
        ]);

        if($this->checkMenuCommand($command, $bot)){
            if($request->expectsJson()){
                return response()->json(['message' => 'Command telah digunakan'], 403);
            }
            return redirect()->route('settings.bots.menus.index')
                ->with('error', 'Command telah digunakan');
        }
        
        $menu = BotMenu::updateOrCreate(
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
                'message'  => "Success store $message menu: " . $menu->name
            ]);
        }

        return redirect()->route('settings.bots.menus.index')
            ->with('success', "Success store $message menu: " . $menu->name);
    }

    /**
     * Delete a menu.
     */
    public function delete(int $id)
    {

        $menu = BotMenu::find($id);

        if (!$menu) {
            return redirect()->route('settings.bots.menus.index')
                ->with('failed', 'Tag not found.');
        }

        if ($menu->delete()) {
            return redirect()->route('settings.bots.menus.index')
                ->with('success', 'Success delete menu: ' . $menu->title);
        }

        return redirect()->route('posts.index')
            ->with('failed', 'Failed delete menu: ' . $menu->title);
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
            BotMenu::whereIn('id', $request->ids)->delete();

            return response()->json([
                'message' => 'Selected menus removed successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while removing selected menus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

