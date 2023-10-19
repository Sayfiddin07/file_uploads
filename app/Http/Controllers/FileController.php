<?php

namespace App\Http\Controllers;

use App\Actions\File\DeleteFileAction;
use App\Actions\File\StoreFileAction;
use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use App\Models\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

use Throwable;

class FileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('user')){

        };

    }

    public function store(StoreFileRequest $request, StoreFileAction $storeFileAction): JsonResponse
    {
        try {
            $file = $request->file('file');
            $result = $storeFileAction->execute($file);
            return ResponseHelper::success(data: $result->toArray());
        } catch (Throwable $e) {
            return ResponseHelper::success(message: $e->getMessage());
        }
    }

    public function destroy(User $user, File $file, DeleteFileAction $deleteFileAction): JsonResponse
    {
        $this->authorize('delete');
        try {
            $deleteFileAction->exectue($user, $file);
            return ResponseHelper::success(message: 'Successfully deleted');

        } catch (Throwable $e) {
            return ResponseHelper::error(message: $e->getMessage());
        }
    }
}
