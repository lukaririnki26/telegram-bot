<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotState extends Model
{
    protected $fillable = [
        'bot_id', 'name', 'mode', 'request', 'response', 'failed_response', 'menus', 'next_state_id'
    ];

    protected $casts = [
        'menus' => 'object'
    ];

    public function bot()
    {
        return $this->belongsTo(Bot::class);
    }
}
