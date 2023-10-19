<?php

namespace App\Actions\Auth;

class LogoutAction
{
    public function execute(): void
    {
        auth()->logout();
    }
}
