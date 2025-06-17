<?php
namespace App\Services;

class BarcodeReaderService
{
    public function scan(string $imagePath): ?string
    {
        $output = shell_exec("zbarimg " . escapeshellarg($imagePath));
        
        // Example output: "QR-Code:Hello World"
        if ($output && strpos($output, ':') !== false) {
            return trim($output);
        }

        // if ($output && preg_match('/^[A-Z0-9\-]+:(.+)$/', trim($output), $matches)) {
        //     return trim($matches[1]); // Only the actual barcode value
        // }

        return null;
    }
}