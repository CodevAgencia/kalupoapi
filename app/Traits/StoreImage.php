<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait StoreImage
{

    /**
     * Store image for model
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int $maxSize = 0
     * @return string|bool
     */
    public static function storeImage(UploadedFile $file, string $folder, int $maxSize = 0): string|bool
    {
        if ($maxSize > 0 && $file->getSize() > $maxSize) {
            return false; // Retorna false si el archivo excede el tamaño máximo
        }
        $path = $file->store("public/$folder");
        $url = Storage::url($path);
        return $url;
    }

    /**
     * get url image for model
     *
     * @param string $path
     * @param string $imageName
     * @return string
     */
    public function imageUrl(string $path): string
    {
        return asset("$path");
    }
}
