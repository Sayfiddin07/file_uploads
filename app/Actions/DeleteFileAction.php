<?php

namespace App\Actions;

use App\Models\User;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class DeleteFileAction
{
    public function exectue(User $user, File $file): void
    {
        $file_user = $file->users();

        if ($file_user->count() === 1 && $file->id ===$file->users()->first()->id) {
            Storage::delete($file->path);
            $file->delete();
            $file_user->detach([$user->id]);
        } else {
            $file_user->detach([$user->id]);

        }
    }
}
