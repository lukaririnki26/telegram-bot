<?php

namespace App\Models\Traits;

use App\Models\Media;

trait MediaTrait
{
    public function medias()
    {
        return $this->morphMany(Media::class, 'entity');
    }

    public function hasMedia(string $role = 'default')
    {
        return $this->getMedia($role)->isNotEmpty();
    }

    public function getMedia(string $role = 'default')
    {
        return $this->medias->where('role', $role);
    }

    public function getFirstMedia(string $role = 'default')
    {
        return $this->getMedia($role)->first();
    }

    public function getLastMedia(string $role = 'default')
    {
        return $this->getMedia($role)->last();
    }

    public function getFirstMediaUrl(string $role = 'default'): string
    {
        if (! $media = $this->getFirstMedia($role)) {
            return '';
        }

        return $media->getUrl();
    }

    public function getMediaUrl(string $role = 'default'): string
    {
        if (! $media = $this->getLastMedia($role)) {
            return '';
        }

        return $media->getUrl();
    }
}
