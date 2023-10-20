<?php

namespace App\Actions\File;

use App\DTO\FileDTO;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreFileAction
{
    public function __construct(
        private readonly AttachFileToUserAction $attachFileToUserAction,
        private readonly CheckFileIdentityAction $checkFileIdentityAction,
    ) {
    }

    public function execute(UploadedFile $uploadedFile)
    {
        $db_files = File::all();
        $local_files = Storage::files("/");

        if (count($db_files) === 0 && count($local_files) === 0) {
            $new_file = File::create(FileDTO::fromStoreRequest($uploadedFile)->toArray());
            return $this->attachFileToUserAction->execute($new_file);
        }
        foreach ($local_files as $local_file) {
            if ($this->checkFileIdentityAction->execute(uploaded_file: $uploadedFile, local_file: $local_file)) {
                if (!$file = File::where('name', '=', $uploadedFile->getClientOriginalName())->first()) {
                    $new_file = File::create([
                        'name' => $uploadedFile->getClientOriginalName(),
                        'path' => $local_file
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
