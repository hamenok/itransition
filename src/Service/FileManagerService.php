<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerService implements FileManagerServiceInterface
{
    private $imagePhotoDirectory;

    public function __construct($imagePhotoDirectory)
    {
        $this->imagePhotoDirectory = $imagePhotoDirectory;
    }

    public function getimagePhotoDirectory()
    {
        return $this->imagePhotoDirectory;
    }

    public function imagePhotoUpload(UploadedFile $file): string
    {
        $fileName = uniqid().'.'.$file->guessExtension();
        try{
            $file->move($this->getimagePhotoDirectory(), $fileName);
        } catch(FileException $exception)
        {
            return $exception;
        }

        return $fileName;
    }

    public function imagePhotoRemove(string $fileName)
    {

    }
}