<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;

class CodepenaController extends Controller
{


  public function pngjpg(Request $request)
     {
         $request->validate([
             'file' => 'required|file|mimes:png|max:10240',
         ]);

         $file = $request->file('file');

         $filePath = $file->getPathname();
         $fileName = $file->getClientOriginalName();

         $response = Http::withHeaders([
             'Authorization' => 'Bearer secret_72M7AEwFlSVzHkpw',
         ])
         ->attach(
             'File', file_get_contents($filePath), $fileName
         )
         ->post('https://v2.convertapi.com/convert/png/to/jpg', [
             'StoreFile' => 'true',
         ]);

         if ($response->successful()) {
             $data = $response->json();
             $jpgUrl = $data['Files'][0]['Url'];

             return response()->json(['url' => $jpgUrl]);
         } else {
             return response()->json(['error' => 'Conversion failed. Please try again.'], 500);
         }
     }

  public function csvxlsx(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv|max:10240',
        ]);

        $file = $request->file('file');

        $filePath = $file->getPathname();
        $fileName = $file->getClientOriginalName();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer secret_72M7AEwFlSVzHkpw',
        ])
        ->attach(
            'File', file_get_contents($filePath), $fileName
        )
        ->post('https://v2.convertapi.com/convert/csv/to/xlsx', [
            'StoreFile' => 'true',
        ]);

        if ($response->successful()) {

            $data = $response->json();
            $xlsxUrl = $data['Files'][0]['Url'];

            return response()->json(['url' => $xlsxUrl]);
        } else {
            return response()->json(['error' => 'Conversion failed. Please try again.'], 500);
        }
    }

  public function xlsxcsv(Request $request)
   {
       $request->validate([
           'file' => 'required|file|mimes:xlsx|max:10240',
       ]);

       $file = $request->file('file');

       $filePath = $file->getPathname();
       $fileName = $file->getClientOriginalName();

       $response = Http::withHeaders([
           'Authorization' => 'Bearer secret_72M7AEwFlSVzHkpw',
       ])
       ->attach(
           'File', file_get_contents($filePath), $fileName
       )
       ->post('https://v2.convertapi.com/convert/xlsx/to/csv', [
           'StoreFile' => 'true',
       ]);

       if ($response->successful()) {
           $data = $response->json();
           $csvUrl = $data['Files'][0]['Url'];

           return response()->json(['url' => $csvUrl]);
       } else {
           return response()->json(['error' => 'Conversion failed. Please try again.'], 500);
       }
   }

    public function wordtopdf(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:doc,docx|max:10240',
        ]);

        $wordFile = $request->file('file');
        $wordFilePath = $wordFile->getRealPath();

        $originalFileName = $wordFile->getClientOriginalName();

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer secret_72M7AEwFlSVzHkpw',
            ])->attach(
                'File', file_get_contents($wordFilePath), $originalFileName
            )->post('https://v2.convertapi.com/convert/docx/to/pdf', [
                'StoreFile' => 'true',
            ]);

            if ($response->successful()) {
                $convertedFileUrl = $response->json()['Files'][0]['Url'] ?? null;

                if ($convertedFileUrl) {
                    return response()->json([
                        'message' => 'File converted successfully!',
                        'url' => $convertedFileUrl,
                    ]);
                } else {
                    return response()->json(['error' => 'No converted file URL returned.'], 400);
                }
            } else {
                return response()->json(['error' => 'Conversion failed.'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Conversion error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred during the conversion.'], 500);
        }
    }


    public function pdftoword(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240',
        ]);

        $pdfFile = $request->file('file');
        $pdfFilePath = $pdfFile->getRealPath();

        $originalFileName = $pdfFile->getClientOriginalName();

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer secret_72M7AEwFlSVzHkpw',
            ])->attach(
                'File', file_get_contents($pdfFilePath), $originalFileName
            )->post('https://v2.convertapi.com/convert/pdf/to/docx', [
                'StoreFile' => 'true',
            ]);

            if ($response->successful()) {
                $convertedFileUrl = $response->json()['Files'][0]['Url'] ?? null;

                if ($convertedFileUrl) {
                    return response()->json([
                        'message' => 'File converted successfully!',
                        'url' => $convertedFileUrl,
                    ]);
                } else {
                    return response()->json(['error' => 'No converted file URL returned.'], 400);
                }
            } else {
                return response()->json(['error' => 'Conversion failed.'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Conversion error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred during the conversion.'], 500);
        }
    }
}
