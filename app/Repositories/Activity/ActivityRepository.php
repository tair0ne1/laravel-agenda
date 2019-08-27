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
    public function getAll($filters)
    {
        $query = Activity::with('user')
            ->with('status');

        $query = $this->addFilters($query, $filters);

        return $query->paginate(10);
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

    public function finishActivity($id, $date)
    {
        return Activity::where('id', $id)
            ->where('status_id', env('SCHEDULED_STATUS'))
            ->update([
                'status_id' => env('DONE_STATUS'),
                'end_date'  => $date
            ]);
    }

    private function addFilters($query, $filters)
    {
        if (isset($filters['initial_date'])) {
            $query->where('start_date', '>=', $filters['initial_date']);
        }

        if (isset($filters['final_date'])) {
            $query->where('deadline', '<=', $filters['final_date']);
        }

        return $query;
    }
}
