<?php

namespace App\Http\Resources\Admin\Bot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BotMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'bot_id' => $this->bot_id,
            'command' => $this->command,
            'response' => $this->response,
            'guard' => $this->guard,
            'role' => $this->role,
            'next_state_id' => $this->next_state_id,
        ];
    }
}
