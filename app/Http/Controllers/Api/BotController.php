<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Bot;
use Telegram\Bot\Api;

class BotController extends ApiController
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:bots,username',
            'token' => 'required|unique:bots,token'
        ]);

        $bot = Bot::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'username' => $request->username,
            'token' => $request->token
        ]);

        return response()->json([
            'message' => 'Bot successfully added',
            'data' => $bot
        ]);
    }

    public function setWebhook(Request $request, Bot $bot)
    {
        $request->validate([
            'url' => 'required',
        ]);
        if($request->url == 'default') {
            $webhookUrl = url("/webhook/{$bot->id}");
            
        }else{
            $webhookUrl =  $request->url;
        }
        $telegram = new Api($bot->token);
        $response = $telegram->setWebhook(['url' => $webhookUrl]);
        return response()->json([
            'message' => 'Webhook successfully setted',
            'response' => $response
        ]);
    }
}
