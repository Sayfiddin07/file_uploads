<?php

namespace App\Actions;

use App\Models\File;

class AttachFileToUserAction
{
    public function execute(File $file)
    {
        $file->users()->sync([
            'user_id' => 1
        ]);
        return $file;
    }
}
