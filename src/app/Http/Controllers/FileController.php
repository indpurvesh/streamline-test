<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\Directory;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Directory $directory)
    {
        return $directory->load(['children', 'files']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Directory $directory, FileRequest $request)
    {
        /** @var $file \Illuminate\Http\UploadedFile */
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
        $fileModel = $directory->files()
            ->create([
                'path' => $path,
                'mime_type' => $file->getMimeType()
            ]);
        
        
        return new JsonResponse([
            'success' => true,
            'message' => __('File Uploaded Successfully'),
            'file_model' => $fileModel
        ]);
    }

}
