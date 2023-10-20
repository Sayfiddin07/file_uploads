<?php

namespace App\Actions\File;

use Illuminate\Support\Facades\Storage;

class CheckFileIdentityAction
{
    public function execute($uploaded_file, $local_file): bool
    {
        return Storage::has($local_file) && md5_file($uploaded_file) === md5_file(storage_path() . '/app/uploads/' . $local_file);
    }
}
