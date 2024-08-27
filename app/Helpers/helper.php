<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

if (!function_exists('formatTime')) {
    function formatTime()
    {
        return '1';
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($file, $authorId)
    {
        $pathName = 'storage/art/' . $authorId;
        $path = $file->storeAs($pathName, $file->getClientOriginalName(), 'public');
        return $path;
    }
}

if (!function_exists('getUploadImageSize')) {
    function getUploadImageSize($path)
    {
        $size = getimagesize($path);
        if (blank($size)) {
            return [];
        }
        return [
            'width' => $size[0],
            'height' => $size[1],
        ];
    }
}
if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('getImageUrl')) {
    function getImageUrl($path)
    {
        return asset($path);
    }
}
