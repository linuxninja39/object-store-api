<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function list(Request $request)  {
        return Storage::disk('local')->files('');
    }

    public function getFile(Request $request, $fileName)  {
        Log::debug('filename', [$fileName]);
        try {
            return Storage::disk('local')->download($fileName);
        } catch (FileNotFoundException $e) {
            return response("file '$fileName' not found", 404);
        }
    }

    public function upload(Request $request)  {
        Log::debug('request', [$request]);
        $uploadedFile = $request->file('file');
        Log::debug('uploadedFile', [$uploadedFile]);
        if (!$uploadedFile) {
            return response('File empty', 400);
        }

        $fileName = $uploadedFile->getClientOriginalName();

        Storage::disk('local')->putFileAs(
            '',
            $uploadedFile,
            $fileName
        );
    }
}
