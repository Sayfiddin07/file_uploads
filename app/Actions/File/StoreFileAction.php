<?php

namespace App\Actions\File;

use App\DTO\FileDTO;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreFileAction
{
    public function __construct(
        private readonly AttachFileToUserAction  $attachFileToUserAction,
        private readonly CheckFileIdentityAction $checkFileIdentityAction,
    )
    {
    }

    public function execute(UploadedFile $uploadedFile)
    {
        $files = File::all();
        if (count($files) === 0) {
            $new_file = File::create(FileDTO::fromStoreRequest($uploadedFile)->toArray());
            return $this->attachFileToUserAction->execute($new_file);
        }
        foreach ($files as $file_item) {
            $similar_hash = $this->checkFileIdentityAction->execute(uploaded_file: $uploadedFile, local_file: $file_item);
            $similar_name = (bool)File::where('name', '=', $uploadedFile->getClientOriginalName())->first();
            if ($similar_name && !$similar_hash) {
                return $this->attachFileToUserAction->execute($file_item);
            }
            if ($similar_hash && !$similar_name) {
                $new_file = File::create([
                    'name' => $uploadedFile->getClientOriginalName(),
                    'path' => $file_item->path
                ]);
                return $this->attachFileToUserAction->execute($new_file);
            }
            if (!$similar_name && !$similar_hash) {
                $new_file = File::create(FileDTO::fromStoreRequest($uploadedFile)->toArray());
                return $this->attachFileToUserAction->execute($new_file);
            }
            if ($similar_name && $similar_hash) {
                return $this->attachFileToUserAction->execute($file_item);
            }

        }

    }

}
