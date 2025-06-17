<?php

use App\Http\Controllers\BarcodeReaderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OCRController;
use App\Http\Controllers\CamController;

Route::get('/', [CamController::class, 'index']);
Route::post('/process-cam', [CamController::class, 'process'])->name('cam.process');


Route::get('/ocr', [OCRController::class, 'index']);
Route::post('/process-ocr', [OCRController::class, 'process'])->name('ocr.process');

Route::get('/barcode', [BarcodeReaderController::class, 'index']);
Route::post('/process-barcode', [BarcodeReaderController::class, 'readBarcode'])->name('barcode.process');
