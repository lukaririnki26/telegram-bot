<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public static function serveAsset($filePath)
    {
        $filePath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, resource_path($filePath));

        if (file_exists($filePath)) {
            // Get file information
            $filePathInfo = pathinfo($filePath);

            // Safely retrieve MIME type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $filePath);
            finfo_close($finfo);

            // Set headers for file download
            header('Content-Disposition: attachment; filename="' . $filePathInfo['basename'] . '"');
            header('Cache-Control: private, max-age=60, must-revalidate');
            header('Content-Transfer-Encoding: binary');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($filePath)) . ' GMT');
            header('Content-Type: ' . $mimeType);
            header('Content-Length: ' . filesize($filePath));
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

            // Output file content securely
            ob_clean();
            flush();
            readfile($filePath);
            exit;
        } else {
                // Return a 404 response if the file does not exist
                abort(404, 'File not found');
        }
    }
}
