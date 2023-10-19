<?php

namespace App\Actions\File;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DeleteFileAction
{
    public function exectue(User $user, File $file): void
    {
        $file_user = $file->users();
        if ($file_user->count() === 1 && $file->id ===$file->users()->first()->id) {
            $file_user->detach([$user->id]);
            Storage::delete($file->path);
            $file->delete();
        } else {
            $file_user->detach([$user->id]);

        }
    }
}
