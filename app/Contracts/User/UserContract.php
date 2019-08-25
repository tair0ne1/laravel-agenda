<?php

namespace App\Contracts\User;

/**
 * Interface UserContract
 *
 * @package App\Contracts\User
 */
interface UserContract
{
    /**
     * Get all users
     * @return array User
     */
    public function getAll();
}
