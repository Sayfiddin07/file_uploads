<?php

namespace App\Actions\Auth;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\TokenDTO;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginAction
{
    public function __construct(private readonly TokenResponseAction $tokenResponseAction)
    {
    }

    /**
     * @throws JWTException
     */
    public function execute(LoginDTO $data): array
    {
        $credentials = $data->toArray();
        if (!$token = auth()->attempt($credentials)) {
            throw new JWTException("Invalid Credentials");
        }
        return $this->tokenResponseAction->execute(TokenDTO::fromStr($token));
    }
}
