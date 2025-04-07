<?php
namespace App\Http\Controllers\Api;

use App\Models\Bot;
use Telegram\Bot\Api;
use App\Models\UserState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends ApiController
{
    public function handle(Request $request, $botId)
    {
        Log::info("Bot ID {$botId} Sedang Bekerja");
        $bot = Bot::findOrFail($botId);
        $telegram = new Api($bot->token);
        $update = $telegram->getWebhookUpdate();

        $chatId = $update->getMessage()->getChat()->getId();
        $text = $update->getMessage()->getText();
        $chatId = $update->getMessage()->getChat()->getId();
        $text = $update->getMessage()->getText();

        $userState = UserState::where('chat_id', $chatId)->first();

        // Jika user sedang menunggu input nama
        if ($userState) {
            if($userState->state !== null){
                // Reset status user
                $userState->update(['state' => null]);
                return;
            }
        }
        $isLoggedIn =  null;

        // Ambil menu dari database
        $menus = $bot->menus()
            ->whereNot('command', '/start')
            ->where('guard', $isLoggedIn ? 'auth' : 'guest')
            ->pluck('command')->toArray();

        // Buat keyboard dalam bentuk array
        $keyboard = [
            'keyboard' => array_chunk($menus, 2), // Menampilkan 2 tombol per baris
            'resize_keyboard' => true, // Keyboard otomatis disesuaikan
            'one_time_keyboard' => false // Keyboard tetap tampil
        ];
        
        // Cek apakah teks yang diketik ada di database menu
        $menu = $bot->menus()->where('command', $text)->first();

        if ($menu) {
            $responseText = $menu->response;
        } else {
            $responseText = "Perintah tidak dikenali.";
        }

        // Jika pengguna mengetik "/start", tampilkan menu
        if ($text == "/start") {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $responseText,
                'reply_markup' => json_encode($keyboard)
            ]);
            return response()->json(['message' => 'Keyboard sent']);
        }

        if ($text != "/start") {
            // Simpan status user agar menunggu inputan
            UserState::updateOrCreate(['chat_id' => $chatId], ['state' => $menu->next_state_id]);

            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $responseText
            ]);
            return;
        }

        // Kirim balasan
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $responseText
        ]);

        return response()->json(['message' => 'Success']);
    }
}
