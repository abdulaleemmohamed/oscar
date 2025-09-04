<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait Delete_final
{
    public function Delete_attachment($disk, $path ,$id)
    {

        Storage::disk($disk)->deleteDirectory($path);
        image::where('imageable_id', $id)->delete();
    }

}
