<?php

namespace App\Actions\File;

use App\Models\File;

class AttachFileToUserAction
{
    public function execute(File $file): File
    {
        if(!auth()->user()->files->contains($file->id)){
            auth()->user()->files()->attach($file->id);
        };
        return $file;
    }
}
