<?php

namespace App\Repositories\Status;

use App\Contracts\Status\StatusContract;
use App\Models\Status;

/**
 * Class StatusRepository
 *
 * @package App\Repositories\Status
 */
class StatusRepository implements StatusContract
{
    public function getAll()
    {
        return Status::get();
    }
}
