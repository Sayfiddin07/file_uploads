<?php

namespace App\Actions\File;

use App\DTO\FileDTO;
use App\Models\File;
use Illuminate\Http\UploadedFile;

class StoreFileAction
{
    public function __construct(
        private readonly AttachFileToUserAction $attachFileToUserAction,
        private readonly CheckFileIdentityAction $checkFileIdentityAction,
    ) {
    }

    public function execute(UploadedFile $uploadedFile)
    {
        $files = File::all();

        if (count($files) === 0) {
            $new_file = File::create(FileDTO::fromStoreRequest($uploadedFile)->toArray());
            return $this->attachFileToUserAction->execute($new_file);
        }
        foreach ($files as $local_file) {
            if ($this->checkFileIdentityAction->execute(uploaded_file: $uploadedFile, local_file: $local_file)) {
                if (!$file = File::where('name', '=', $uploadedFile->getClientOriginalName())->first()) {
                    $new_file = File::create([
                        'name' => $uploadedFile->getClientOriginalName(),
                        'path' => $local_file->path,
                        'md5' => $local_file->md5
                    ]);
                    return $this->attachFileToUserAction->execute($new_file);

                } else {
                    return $this->attachFileToUserAction->execute($file);
                }
            }

        }
        $new_file = File::create(FileDTO::fromStoreRequest($uploadedFile)->toArray());
        return $this->attachFileToUserAction->execute($new_file);
    }

}
