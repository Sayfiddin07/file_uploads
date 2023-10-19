<?php

namespace App\DTO;

use App\Http\Requests\StoreFileRequest;
use Spatie\LaravelData\Data;

class FileDTO extends Data
{
    public function __construct(
        public string $name,
        public string $path
    )
    {
    }
    public static function fromStoreRequest(StoreFileRequest $request): self
    {
        $file = $request->file('file');

        return new self(
            name: $file->getClientOriginalName(),
            path: $file->storeAs('/', time() . "_" .$file->getClientOriginalName())
        );
    }
}
