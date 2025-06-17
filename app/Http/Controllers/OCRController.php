<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OCRService;
use Exception;

class OCRController extends Controller
{
    public function index()
    {
        return view('ocr.index');
    }

    public function process(Request $request, OCRService $ocrService)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,bmp,tiff|max:5120'
        ]);

        // $file = $request->file('image');
        // $filename = time() . '.' . $file->getClientOriginalExtension();

        // $destination = public_path('uploads');
        // $file->move($destination, $filename);

        // $absolutePath = $destination . '/' . $filename;
        $absolutePath = $request->file('image')->getPathname();

        // Make sure file exists (optional safety)
        if (!file_exists($absolutePath)) {
            abort(404, 'Uploaded image not found.');
        }
        
        // OCR processing
        $extractedText = $ocrService->extractText($absolutePath);

        return view('ocr.result', compact('extractedText'));
    }
}
