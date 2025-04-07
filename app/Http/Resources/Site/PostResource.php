<?php

namespace App\Http\Resources\Site;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'slug'               => $this?->slug,
            'description'        => Str::words(strip_tags($this->content), 20, '....'),
            'content'            => strip_tags($this->content),
            'image'              => $this?->image ?? null,
            'author'             => $this?->createdBy?->people?->full_name ?? $this?->createdBy?->username ?? 'Admin',
            'created_at'         => $this->created_at,
        ];
    }
}
