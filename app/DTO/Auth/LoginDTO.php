<?php

namespace app\DTO\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Spatie\LaravelData\Data;

class LoginDTO extends Data
{
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }

    public static function fromRequest(LoginRequest $request): self
    {
        return new self(
            email: str($request->input('email'))->trim()->toString(),
            password: str($request->input('password'))->trim()->toString(),
        );
    }
}
