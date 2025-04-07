<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Models\BotMenu;
use App\Models\Bot;

class BotMenuController extends ApiController
{
    public function index(Bot $bot)
    {
        return response()->json($bot->menus);
    }

    private function checkMenuCommand(string $command, Bot $bot){
        return $bot->menus()->where('command', $command)->exists();
    }

    public function store(Request $request, Bot $bot)
    {
        $request->validate([
            'command' => 'required|string',
            'response' => 'required|string',
        ]);
        if($this->checkMenuCommand($command, $bot)){
            return response()->json(['message' => 'Command telah digunakan'], 403);
        }

        $menu = $bot->menus()->create([
            'command' => $request->command,
            'response' => $request->response,
        ]);

        return response()->json(['message' => 'Menu berhasil ditambahkan', 'menu' => $menu]);
    }

    public function update(Request $request, BotMenu $menu)
    {
        $request->validate([
            'command' => 'required|string',
            'response' => 'required|string',
        ]);

        if($this->checkMenuCommand($command, $bot)){
            return response()->json(['message' => 'Command telah digunakan'], 403);
        }

        $menu->update([
            'command' => $request->command,
            'response' => $request->response,
        ]);

        return response()->json(['message' => 'Menu berhasil diperbarui', 'menu' => $menu]);
    }

    public function destroy(BotMenu $menu)
    {
        $menu->delete();
        return response()->json(['message' => 'Menu berhasil dihapus']);
    }
}