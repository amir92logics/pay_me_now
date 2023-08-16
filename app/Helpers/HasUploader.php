<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait HasUploader
{
    private function upload(Request $request, $input, $oldFile = null, $full_url = null)
    {
        $file = $request->file($input);
        $ext = $file->getClientOriginalExtension();
        $filename = now()->timestamp.'.'.$ext;

        $path = 'public/storage/uploads' . \Auth::id() . date('/y') . '/' . date('m') . '/';
        $filePath = $path.$filename;

        if($oldFile) {
            if (file_exists($oldFile)) {
                Storage::delete($oldFile);
            }
        }

        Storage::put($filePath, file_get_contents($file));

        return $full_url.$filePath;
    }

}
