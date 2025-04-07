<?php

namespace Database\Seeders;

use App\Models\Bot;
use App\Models\User;
use App\Models\BotMenu;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            ['name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'msisdn' => '62842482847824',
            'msisdn_verified_at' => now(),
            'password' => bcrypt('password'), // Default password
            'remember_token' => Str::random(10),
            'language' => 'en'
            ]
        );

        $bots = [
            [
                'user_id' => $user->id,
                'name' => 'Hawk Eye',
                'username' => 'tele_dym_bot',
                'token' => '7451391346:AAFbIHangmQeYTWV44qg8u_bejH-NrRd-xU',
                'welcome_text' => 'Hi, selamat datang di Hawkeye Bot',
                'unactive_text' => 'Saat ini bot sedang tidak aktif',
            ],
            [
                'user_id' => $user->id,
                'name' => 'TemanProskpek Bot',
                'username' => 'temanprospek_bot',
                'token' => '8114051918:AAE9p_gdRzFEO09fm2lrDfmeHNyJukOTass',
                'welcome_text' => '👋 Halo! Saya TemanProspek Bot.  
Pilih cara Anda ingin filter data leads:  
1. Berdasarkan Lokasi  
2. Berdasarkan Umur  
3. Berdasarkan Segmentasi  
4. Berdasarkan Skor  
5. Lihat Semua Leads',
                'unactive_text' => 'Saat ini bot sedang tidak aktif',
            ],
        ];
        $hawkeye = Bot::create($bots[0]);
        $temanprospek = Bot::create($bots[1]);

        $bots_menu = [
            'hawkeye' => [
                [
                    'command' => '🔐login',
                    'response' => 'Masukkan Email anda',
                    'guard' => 'guest',
                    'role' => [],
                    'next_state_id' => null,
                ],
                [
                    'command' => '🔍findlocationbycid ',
                    'response' => 'Masukkan Nomor CID',
                    'guard' => 'auth',
                    'role' => [],
                    'next_state_id' => null,
                ],
                [
                    'command' => '🔍findciddata',
                    'response' => 'Masukkan Nomor CID',
                    'guard' => 'auth',
                    'role' => [],
                    'next_state_id' => null,
                ],
            ],
            'temanprospek' => [
                [
                    'command' => '/info',
                    'response' => 'halo',
                    'guard' => 'guest',
                    'role' => [],
                    'next_state_id' => null,
                ],
            ]
        ];

        foreach($bots_menu['hawkeye'] as $bmenu){
            BotMenu::create(array_merge($bmenu, [
                'bot_id' => $hawkeye->id
            ]));
        }
        foreach($bots_menu['temanprospek'] as $bmenu){
            BotMenu::create(array_merge($bmenu, [
                'bot_id' => $temanprospek->id
            ]));
        }

    // $bot_states = [
    //     [
    //         ''
    //     ]
    // ] 

    }
}
