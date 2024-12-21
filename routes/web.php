<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodepenaController;


Route::get('/', function () {
    return view('components/dashboard');
});

Route::get('/cvgenerator', function () {
    return view('components/cvgenerator');
});

Route::get('/pdfword', function () {
    return view('components/pdftoword');
});


Route::get('/wordpdf', function () {
    return view('components/wordtopdf');
});

Route::get('/xlsxcsv', function () {
    return view('components/xlsxtocsv');
});

Route::get('/csvxlsx', function () {
    return view('components/csvtoxlsx');
});


Route::get('/pngjpg', function () {
    return view('components/pngtojpg');
});


Route::get('/jpgpng', function () {
    return view('components/jpgtopng');
});


Route::get('/webppng', function () {
    return view('components/webptopng');
});

//ACTION KONVERT DOKUMEN
Route::post('/convert-pdf-to-word', [CodepenaController::class, 'pdftoword'])->name('convert.pdf-to-word');
Route::post('/convert-word-to-pdf', [CodepenaController::class, 'wordtopdf'])->name('convert.word-to-pdf');
Route::post('/convert-xlsx-to-csv', [CodepenaController::class, 'xlsxcsv'])->name('convert.xlsx-to-csv');
Route::post('/convert-csv-to-xlsx', [CodepenaController::class, 'csvxlsx'])->name('convert.csv-to-xlsx');
Route::post('/convert-png-to-jpg', [CodepenaController::class, 'pngjpg'])->name('convert.png-to-jpg');
Route::post('/convert-webp-to-png', [CodepenaController::class, 'webppng'])->name('convert.webp-to-png');
