<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contracts\Activity\ActivityContract;
use App\Http\Requests\ActivityRequest;
use App\Http\Requests\IndexActivityRequest;

class ActivitiesController extends Controller
{

    protected $activityRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivityContract $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexActivityRequest $request)
    {
        return $this->activityRepository->getAll($request->validated());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {
        return $this->activityRepository->save($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->activityRepository->get($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityRequest $request, $id)
    {
        return $this->activityRepository->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->activityRepository->delete($id);
    }

    /**
     * Finish the scheduled activity.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function finishActivity($id)
    {
        return $this->activityRepository->finishActivity($id);
    }
}
