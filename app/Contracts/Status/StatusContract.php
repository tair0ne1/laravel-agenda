<?php

namespace App\Contracts\Status;

/**
 * Interface StatusContract
 *
 * @package App\Contracts\Status
 */
interface StatusContract
{
    /**
     * Get all statuses
     * @return array Status
     */
    public function getAll();
}
