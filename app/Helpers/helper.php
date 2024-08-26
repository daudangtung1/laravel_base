<?php

use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

if (!function_exists('formatTime')) {
    function formatTime()
    {
        return '1';
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($file, $authorId)
    {
        $pathName = 'public/art/' . $authorId;
        $path = $file->store($pathName);
        return $path;
    }
}

if (!function_exists('getImageSize')) {
    function getImageSize($path)
    {
        $image = Image::make(storage_path('app/' . $path));
        $width = $image->width();
        $height = $image->height();
        return [
            'width' => $width,
            'height' => $height,
        ];
    }
}
