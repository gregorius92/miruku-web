<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    /**
     * Handle CKEditor image upload.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            try {
                // Upload image using the existing service
                // Using 'cms' directory for general editor uploads
                $path = UploadService::upload($request->file('upload'), 'cms');
                
                // Get the public URL from Supabase storage
                $url = Storage::disk('supabase')->url($path);

                return response()->json([
                    'url' => $url
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => [
                        'message' => 'Upload failed: ' . $e->getMessage()
                    ]
                ], 500);
            }
        }

        return response()->json([
            'error' => [
                'message' => 'No file uploaded.'
            ]
        ], 400);
    }
}
