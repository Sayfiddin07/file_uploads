<?php

namespace App\Actions\Auth;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
class CurrentUserAction
{
    /**
     * @throws JWTException
     */
    public function execute(?Authenticatable $user): Authenticatable | User
    {
        if ($user === null) {
            throw new JWTException('Unauthorized');
        }
        return $user;
    }
}
