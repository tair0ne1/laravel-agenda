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
        return Activity::with('user')
            ->with('status')
            ->paginate(10);
    }

    public function save($activity)
    {
        return Activity::create($activity);
    }

    public function get($id)
    {
        return Activity::with('user')
            ->with('status')
            ->find($id);
    }

    public function getIntersection($activity)
    {
        return Activity::where('user_id', $activity['user_id'])
            ->whereNotIn('id', function($query) use ($activity) {
                $query->select('id')
                    ->from('activities')
                    ->where('user_id', $activity['user_id'])
                    ->where('deadline', '<', $activity['start_date'])
                    ->orWhere('start_date', '>', $activity['deadline'])
                    ->get();
            })
            ->get();
    }

    public function update($activity, $id)
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
