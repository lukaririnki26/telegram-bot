<?php
namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Symfony\Component\Mime\MimeTypes;

class File
{
    /**
     * Get the directory name of path, trimming unnecessary `.` and `/` characters.
     * @param  string $path
     * @return string
     */
    public static function cleanDirname(string $path): string
    {
        $dirname = pathinfo($path, PATHINFO_DIRNAME);

        if ($dirname == '.') {
            return '';
        }

        return trim($dirname, '/');
    }

    /**
     * Remove any disallowed characters from a directory value.
     * @param string $path
     * @param string|null $language
     * @return string
     */
    public static function sanitizePath(string $path, ?string $language = null): string
    {
        $language = $language ?: App::currentLocale();

        return trim(
            preg_replace(
                '/[^a-zA-Z0-9-_\/.%]+/',
                '-',
                Str::ascii($path, $language)
            ),
            DIRECTORY_SEPARATOR . '-'
        );
    }

    /**
     * Remove any disallowed characters from a filename.
     * @param string $file
     * @param string|null $language
     * @return string
     */
    public static function sanitizeFileName(string $file, ?string $language = null): string
    {
        $language = $language ?: App::currentLocale();

        return trim(
            preg_replace(
                '/[^a-zA-Z0-9-_.%]+/',
                '-',
                Str::ascii($file, $language)
            ),
            '-'
        );
    }

    /**
     * Generate a human-readable byte count string.
     * @param int|null $bytes
     * @param int $precision
     * @return string
     */
    public static function readableSize(null|int $bytes, int $precision = 1): string
    {
        static $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        if ($bytes === 0 || is_null($bytes)) {
            return '0 ' . $units[0];
        }
        $exponent = (int) floor(log($bytes, 1024));
        $value = $bytes / pow(1024, $exponent);

        return round($value, $precision) . ' ' . $units[$exponent];
    }

    /**
     * Returns the extension based on the mime type.
     *
     * If the mime type is unknown, returns null.
     *
     * @param  string $mimeType
     * @return string|null The guessed extension or null if it cannot be guessed
     *
     * @see MimeTypes
     */
    public static function guessExtension(string $mimeType): ?string
    {
        // use Symfony MimeTypes component if available (symfony/http-foundation v4.3+)
        if (class_exists(MimeTypes::class)) {
            return MimeTypes::getDefault()->getExtensions($mimeType)[0] ?? null;
        }

        return null;
    }

    public static function joinPathComponents(string ...$components): string
    {
        $path = '';

        foreach ($components as $component) {
            if (empty($component)) {
                continue;
            }

            if (empty($path)) {
                $path = $component;

                continue;
            }
            $path = rtrim($path, '/') . '/' . ltrim($component, '/');
        }

        return $path;
    }
}
