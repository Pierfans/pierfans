<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CoconutUploadService
{
    public static function video(Model $media, $field, $filePath, $storage, $request)
    {
        // Video Upload
        if ($request->hasFile('encoded_video') && $request->video_id) {

            \Log::info('CoconutUploadService: Processing video upload');
            \Log::info('Processing video upload for field: ' . $field);
            \Log::info('Video ID: ' . $request->video_id);
            \Log::info('File Path: ' . $filePath);
            \Log::info('Storage parameter: ' . $storage);

            \Log::info('Default storage disk: ' . config('filesystems.default'));

            $file = $request->file('encoded_video');
            $extension = $request->file('encoded_video')->getClientOriginalExtension();
            $fileName = 'converted-' . str_random(20) . uniqid() . now()->timestamp;
            $fileUpload = $fileName . '.' . $extension;

            // Video folder temp
            $videoPathDisk = 'temp/' . $filePath;

            \Log::info('Video path disk: ' . $videoPathDisk);
            \Log::info('File upload name: ' . $fileUpload);

            $uploadResult = $file->storePubliclyAs($storage, $fileUpload, config('filesystems.default'));
            \Log::info('Upload result: ' . ($uploadResult ?: 'false. No file uploaded.'));

            while (ob_get_level()) {
                ob_end_clean();
            }

            if ($uploadResult) {
                $media->update([
                    $field => $fileUpload,
                ]);

                \Log::info('Attempting to delete file: ' . $videoPathDisk);
                \Log::info('File exists: ' . (Storage::disk(config('filesystems.default'))->exists($videoPathDisk) ? 'yes' : 'no'));

                // Delete old video
                Storage::disk('default')->delete($videoPathDisk);
            }
        }
    }

    public static function poster(Model $media, $storage, $request)
    {
        if ($request->hasFile('encoded_video') && !$request->video_id) {
            while (ob_get_level()) {
                ob_end_clean();
            }

            $file = $request->file('encoded_video');
            $extension = $request->file('encoded_video')->getClientOriginalExtension();
            $fileName = 'poster-' . str_random(20) . uniqid() . now()->timestamp;
            $fileUpload = $fileName . '.' . $extension;


            $uploadResult = $file->storePubliclyAs($storage, $fileUpload, config('filesystems.default'));
            if ($uploadResult) {
                $media->update([
                    'video_poster' => $fileUpload,
                ]);
            }
        }
    }
}
