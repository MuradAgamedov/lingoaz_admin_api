<?php

namespace App\Helpers;

class FileHelper
{
    public static function storeFile($file, $path = 'public')
    {
        return $file->store($path, 'public');
    }
    
    public static function storeFiles($files, $path = 'public')
    {
        $files = [];
        foreach ($files as $file) {
            $files[] = self::storeFile($file, $path);
        }
        return $files;
    }
}