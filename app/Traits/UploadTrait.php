<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{

    public function uploadImage(
        Request $request,$disk,
        $inputName,
        $folderName,
        $imageable_id,
        $imageable_type
    ) {
        if ($request->has($inputName)) {

            $photo = $request->file($inputName);
            $name = \Str::slug($request->input('name'));
            $filename = $name . '.' . $photo->getClientOriginalExtension();
            $path = $request->file($inputName)->storeAs($folderName, $filename, $disk);
            Image::create([
                'fileName' => $path,
                'imageable_id' => $imageable_id,
                'imageable_type' => $imageable_type,
            ]);
        }
    }//end of uploadImage
    public function deleteImage($disk, $id)
    {
        $images= Image::where('imageable_id', $id)->get();
        foreach ($images as $image) {
            Storage::disk($disk)->delete($image->fileName);
            $image->delete();
        }
    }
}
