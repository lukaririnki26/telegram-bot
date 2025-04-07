<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'sys_medias';

    protected $fillable = [
        'entity_type', 'entity_id', 'name', 'file_name', 'disk', 'mime_type', 'size', 'role'
    ];

    public function entity()
    {
        return $this->morphTo('entity');
    }

    /**
     * Get the file extension.
     *
     * @return string
     */
    public function getExtensionAttribute(): string
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    /**
     * Get the file type.
     *
     * @return string|null
     */
    public function getTypeAttribute(): ?string
    {
        return Str::before($this->mime_type, '/') ?? null;
    }

    /**
     * Determine if the file is of the specified type.
     *
     * @param string $type
     * @return bool
     */
    public function isOfType(string $type): bool
    {
        return $this->type === $type;
    }

    /**
     * Get the url to the file.
     *
     * @return string
     */
    public function getUrl(): string
    {
        if (in_array($this->disk, ['s3', 'do_space', 'linode', 'vultr', 'gcs'])) {
            return $this->filesystem()->temporaryUrl(
                $this->getPath(),
                Carbon::now()->addHour()
            );
        }

        return $this->filesystem()->url(
            $this->getPath()
        );
    }

    /**
     * Get the full path to the file.
     *
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->filesystem()->path(
            $this->getPath()
        );
    }

    /**
     * Get the path to the file on disk.
     *
     * @return string
     */
    public function getPath(): string
    {
        $directory = $this->getDirectory();

        return $directory . DIRECTORY_SEPARATOR . $this->file_name;
    }

    public function getDirectory()
    {
        return $this->getKey();
    }

    /**
     * Get the filesystem where the associated file is stored.
     *
     * @return \Illuminate\Contracts\Filesystem\Filesystem|\Illuminate\Filesystem\FilesystemAdapter
     */
    public function filesystem()
    {
        return Storage::disk($this->disk);
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return \App\Helpers\File::readableSize($this->size);
    }
}
