<?php

namespace App\Http\Controllers;

use App\Actions\AttachFileToUserAction;
use App\Actions\DeleteFileAction;
use App\Actions\StoreFileAction;
use App\DTO\FileDTO;
use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\User;
use Illuminate\Support\Collection;
use Throwable;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{


    public function index(): Collection
    {
        return File::all();
    }

    public function store(StoreFileRequest $request, StoreFileAction $storeFileAction, AttachFileToUserAction $attachFileToUserAction)
    {
        try {
            $files = File::all();

            if (count($files) === 0) {
                return $storeFileAction->execute(FileDTO::fromStoreRequest($request));
            }

            foreach ($files as $file) {
                if (
                    Storage::has($file->path) && md5_file($request->file('file')) === md5_file(storage_path() . '/app/uploads/' . $file->path)) {
                    return $attachFileToUserAction->execute($file);
                }
            }
            return $storeFileAction->execute(FileDTO::fromStoreRequest($request));

        } catch (Throwable $e) {
            return $e;
        }


    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, File $file, DeleteFileAction $deleteFileAction)
    {
        try {
            $deleteFileAction->exectue($user, $file);
            return 'successfully_deleted';
        } catch (Throwable $e) {
            return $e;
        }
    }
}
