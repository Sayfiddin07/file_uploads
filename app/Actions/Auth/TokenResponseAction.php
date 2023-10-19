<?php

namespace App\Actions\Auth;

use App\DTO\Auth\TokenDTO;

class TokenResponseAction
{
    public function execute(TokenDTO $data):array
    {
        return $data->toArray();
    }
}
