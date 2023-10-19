<?php

namespace App\Actions\File;

use App\Models\File;

class AttachFileToUserAction
{
    public function execute(File $file): File
    {
        $file->users()->sync([
            'user_id' => auth()->user()->id
        ]);
        return $file;
    }
}
