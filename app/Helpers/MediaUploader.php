<?php
namespace App\Helpers;

use App\Models\Media;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class MediaUploader
{
    protected $media, $file, $entity, $name, $fileName, $disk, $role;

    public function fromFile(UploadedFile $file)
    {
        $this->setFile($file);
        return $this;
    }

    public function fromPath($path)
    {
        $file = new File($path);
        $this->setFile($file);
        return $this;
    }

    public function setFile($file)
    {
        if ($file instanceof UploadedFile) {
            $this->file = $file;
            $fileName = $file->getClientOriginalName();
        } elseif ($file instanceof File) {
            $this->file = $file;
            $fileName = $file->getFilename();
        } else {
            throw new \InvalidArgumentException("Invalid file type");
        }

        $name = pathinfo($fileName, PATHINFO_FILENAME);
        $this->setName($name);
        $this->setFileName($fileName);

        return $this;
    }

    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function useName(string $name)
    {
        return $this->setName($name);
    }

    public function setFileName(string $fileName)
    {
        $this->fileName = $this->sanitiseFileName($fileName);

        return $this;
    }

    public function useFileName(string $fileName)
    {
        return $this->setFileName($fileName);
    }

    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    protected function sanitiseFileName(string $fileName)
    {
        return str_replace(['#', '/', '\\', ' '], '-', $fileName);
    }

    public function setDisk(string $disk)
    {
        $this->disk = $disk;

        return $this;
    }

    public function toDisk(string $disk)
    {
        return $this->setDisk($disk);
    }

    public function upload()
    {
        if($this->media){
            $media =  $this->media;
        }else{
            $media = new Media();
        }

        if($this->entity){
            $media->entity_type = $this->entity->getMorphClass();
            $media->entity_id = $this->entity->id;

        }
        $media->name = $this->name;
        $media->file_name = $this->fileName;
        $media->disk = $this->disk ?: config('filesystems.default');
        $media->mime_type = $this->file->getMimeType();
        $media->size = $this->file->getSize();
        $media->role = $this->role;
        $media->save();

        $media->filesystem()->putFileAs(
            $media->getDirectory(),
            new File($this->file),
            $this->fileName,
            [
                'VersionId' => uniqid(),
            ]
        );

        return $media->fresh();
    }
}
