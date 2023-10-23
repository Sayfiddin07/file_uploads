<?php

namespace App\Actions\File;

use App\Models\File;

class AttachFileToUserAction
{
    public function execute(File $file): File
    {
        $user = auth()->user();
        if(!$user->files->contains($file->id)){
            $user->files()->attach($file->id);
        };
        return $file;
    }
}
