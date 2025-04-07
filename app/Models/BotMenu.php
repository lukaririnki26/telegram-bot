<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotMenu extends Model
{
    protected $fillable = [
        'bot_id', 'command', 'response', 'guard', 'role', 'next_state_id'
    ];

    protected $casts = [
        'role' => 'object'
    ];

    public function bot()
    {
        return $this->belongsTo(Bot::class);
    }
}
