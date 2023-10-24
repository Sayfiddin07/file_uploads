<?php

namespace App\Actions\File;

class CheckFileIdentityAction
{
    public function execute($uploaded_file, $local_file): bool
    {
        return  md5_file($uploaded_file) === $local_file->md5;
    }
}
