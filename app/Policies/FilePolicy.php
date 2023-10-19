<?php

namespace App\Policies;

use App\Models\User;

class FilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete()
    {
        $user = auth()->user();
        return $user->hasRole('moderator') || $user->hasRole('admin');
    }
}
