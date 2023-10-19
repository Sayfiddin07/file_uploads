<?php

namespace App\DTO;

use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class FileDTO extends Data
{
    public function __construct(
        public ?string $name,
        public ?string $path,
    )
    {}
    public static function fromStoreRequest(UploadedFile $file): self
    {
        return new self(
            name: $file->getClientOriginalName(),
            path: $file->storeAs("/", time() . "_" . $file->getClientOriginalName())
        );
    }

}
