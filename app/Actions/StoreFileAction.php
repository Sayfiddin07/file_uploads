<?php

namespace App\Actions;

use App\DTO\FileDTO;
use App\Models\File;

class StoreFileAction
{
    public function __construct(public AttachFileToUserAction $attachFileToUserAction)
    {
    }

    public function execute(FileDTO $data)
    {
        $file = File::create($data->toArray());
        $this->attachFileToUserAction->execute($file);
        return $file;
    }
}
