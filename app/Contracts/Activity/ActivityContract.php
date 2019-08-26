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
    public function save($activity);

    /**
     * Get one activity
     * @return Activity
     */
    public function get($id);

    /**
     * Get wheter there is intersection
     * or wheter not
     * @return array Activity
     */
    public function getIntersection($activity);

    /**
     * Update one activity
     * @return boolean
     */
    public function update($activity, $id);

    /**
     * Delete one activity
     * @return boolean
     */
    public function delete($id);
}
