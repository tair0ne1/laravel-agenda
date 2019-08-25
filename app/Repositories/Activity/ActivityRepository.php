<?php

namespace App\Repositories\Activity;

use App\Contracts\Activity\ActivityContract;
use App\Models\Activity;

/**
 * Class ActivityRepository
 *
 * @package App\Repositories\Activity
 */
class ActivityRepository implements ActivityContract
{
    public function getAll()
    {
        return Activity::paginate(10);
    }

    public function save(Activity $activity)
    {
        return Activity::create($activity);
    }

    public function get($id)
    {
        return Activity::find($id);
    }

    public function update(Activity $activity, $id)
    {
        return $this->getById($id)->update($activity);
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    private function getById($id)
    {
        return Activity::where('id', $id);
    }
}
