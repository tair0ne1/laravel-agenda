<?php

namespace App\Repositories\User;

use App\Contracts\User\UserContract;
use App\Models\User;

/**
 * Class UserRepository
 *
 * @package App\Repositories\User
 */
class UserRepository implements UserContract
{
    public function getAll()
    {
        return User::get();
    }
}
