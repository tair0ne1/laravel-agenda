<?php

namespace App\Contracts\Activity;

use App\Models\Activity;

/**
 * Interface ActivityContract
 *
 * @package App\Contracts\Activity
 */
interface ActivityContract
{
    /**
     * Get all activities
     * @return array Activity
     */
    public function getAll();

    /**
     * Save a new activity
     * @return Activity
     */
    public function save(Activity $activity);

    /**
     * Get one activity
     * @return Activity
     */
    public function get($id);

    /**
     * Update one activity
     * @return boolean
     */
    public function update(Activity $activity, $id);

    /**
     * Delete one activity
     * @return boolean
     */
    public function delete($id);
}
