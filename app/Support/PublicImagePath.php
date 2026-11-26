<?php

namespace App\Support;

class PublicImagePath
{
    public static function directory(string $subdirectory = ''): string
    {
        $path = dirname(base_path()).DIRECTORY_SEPARATOR.'public_html'.DIRECTORY_SEPARATOR.'images';

        return $subdirectory === ''
            ? $path
            : $path.DIRECTORY_SEPARATOR.trim($subdirectory, '/\\');
    }

    public static function file(string $relativePath): string
    {
        return dirname(base_path()).DIRECTORY_SEPARATOR.'public_html'.DIRECTORY_SEPARATOR
            .str_replace(['/', '\\'], DIRECTORY_SEPARATOR, ltrim($relativePath, '/\\'));
    }
}
