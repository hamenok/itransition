<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileManagerServiceInterface
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function imagePhotoUpload(UploadedFile $file, string $dir): string;

    /**
     * @param imagePhotoRemove $fileName
     * @return string
     */
    public function imagePhotoRemove(string $fileName, string $directory);
}