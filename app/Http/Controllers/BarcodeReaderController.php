<?php

namespace App\Http\Controllers;

use App\Services\BarcodeReaderService;
use Illuminate\Http\Request;

class BarcodeReaderController extends Controller
{
    public function index()
    {
        return view('barcode.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,bmp,tiff|max:5120'
        ]);

        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $destination = public_path('uploads');
        $file->move($destination, $filename);

        $absolutePath = $destination . '/' . $filename;
    }

    public function readBarcode(Request $request, BarcodeReaderService $barcodeService)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,bmp,tiff|max:5120'
        ]);
        
        $absolutePath = $request->file('image')->getPathname();

        // Make sure file exists (optional safety)
        if (!file_exists($absolutePath)) {
            abort(404, 'Uploaded image not found.');
        }

        $barcodeData = $barcodeService->scan($absolutePath);

        return view('barcode.result', compact('barcodeData'));
    }
}
