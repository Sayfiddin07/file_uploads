<?php

namespace App\Http\Controllers;

use App\Actions\File\DeleteFileAction;
use App\Actions\File\StoreFileAction;
use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;


use Throwable;

class FileController extends Controller
{

    public function index():JsonResponse
    {
        try{
            $files = File::initQuery()->get();
            return ResponseHelper::success(data: $files->toArray());
        }catch(Throwable $e){
            return ResponseHelper::error(message: $e->getMessage());
        }

    }

    public function store(StoreFileRequest $request, StoreFileAction $storeFileAction): JsonResponse
    {
        try {
            $file = $request->file('file');
            $result = $storeFileAction->execute($file);
            return ResponseHelper::success(data: $result->toArray());
        } catch (Throwable $e) {
            return ResponseHelper::error(message: $e->getMessage());
        }
    }

    public function destroy(User $user, File $file, DeleteFileAction $deleteFileAction):JsonResponse
    {

        if(!Gate::allows("delete-file", [$file, $user])){
            return ResponseHelper::error(message: "Unauthorized", statusCode:403);
        }

        try {
            $deleteFileAction->execute($user, $file);
            return ResponseHelper::success(message: 'Successfully deleted', statusCode:201);
        } catch (Throwable $e) {
            return ResponseHelper::error(message: $e->getMessage(), statusCode: 500);
        }
    }
}
