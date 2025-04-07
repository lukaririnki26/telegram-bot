<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'file' => $this->getUrl(),
            'name' => $this->name,
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            'role' => $this->role,
        ];
    }
}
