<?php
namespace App\Services;

use thiagoalessio\TesseractOCR\TesseractOCR;

class OCRService
{
    // https://github.com/thiagoalessio/tesseract-ocr-for-php
    public function extractText(string $imagePath, string $lang = 'eng'): string
    {
        //eng eng+deu
        return (new TesseractOCR($imagePath))
            ->lang($lang)
            //  ->allowlist(range('A', 'Z'))
            ->run();
    }
}