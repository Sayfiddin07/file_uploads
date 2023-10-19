<?php

namespace app\DTO\Auth;

use Spatie\LaravelData\Data;

class TokenDTO extends Data
{
    public function __construct(
        public string $access_token,
        public string $token_type,
        public int    $expires_in,
    )
    {
    }

    public static function fromStr(string $token): self
    {
        return new self(
            access_token: $token,
            token_type: 'bearer',
            expires_in: auth()->factory()->getTTL() * 60
        );
    }
}
