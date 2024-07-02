<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $fileName = $image->getClientOriginalName();
            $folder = 'avatar' . rand();
            $image->storeAs('images/tmp/' . $folder, $fileName);
            TemporaryFile::create([
                'folder' => $folder,
                'file' => $fileName
            ]);

            return $folder;
        }
        return '';
    }

    public function deleteUploadFile()
    {
        $temp = TemporaryFile::where('folder', request()->getContent())->first();
        if ($temp) {
            Storage::deleteDirectory('images/tmp/' . $temp->folder);
            $temp->delete();
        }

        return response()->noContent();
    }
}
