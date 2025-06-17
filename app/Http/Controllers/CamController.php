<?php

namespace App\Http\Controllers;

use App\Services\BarcodeReaderService;
use Illuminate\Http\Request;
use App\Services\OCRService;
use Exception;

class CamController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function process(Request $request, OCRService $service)
    {
        $base64Image = $request->input('image');

    if (!$base64Image) {
        return back()->with('error', 'No image data received');
    }

    // Decode the base64 string
    $imageData = base64_decode($base64Image);

    // dd($imageData);
    // Optionally save to disk or process directly from memory
    $filePath = storage_path('app/uploads/' . uniqid() . '.jpg');
    file_put_contents($filePath, $imageData);

    //  dd($filePath);

    // $result = $service->scan($filePath);
    $result = $service->extractText($filePath);

    // Delete file
    unlink($filePath);

    dd($result);
        
    }
}
