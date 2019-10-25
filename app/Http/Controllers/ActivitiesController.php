<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Carbon\Carbon;
use App\Contracts\Activity\ActivityContract;
use App\Http\Requests\ActivityRequest;

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
    public function index(Request $request)
    {
        $rules = [
            'initial_date' => 'nullable|required_with:final_date|date_format:Y-m-d H:i|before:final_date|',
            'final_date'   => 'nullable|required_with:initial_date|date_format:Y-m-d H:i|after:initial_date|',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return $this->activityRepository->getAll($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {
        $activity = $request->validated();

        $this->validateActivity($activity);

        return $this->activityRepository->save($activity);
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
        $activity = $request->validated();

        $this->validateActivity($activity);

        return $this->activityRepository->update($activity, $id);
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
        $now = Carbon::now();

        return $this->activityRepository->finishActivity($id, $now->format('Y-m-d H:i'));
    }

    /**
     * Validate if the activity object is valid.
     */
    private function validateActivity($activity)
    {
        if ($this->haveIntersections($activity)) {
            response()->json('You already have an activity in this time range', 422)->send();
            die();
        }
    }

    /**
     * Validate if there is some intersection in the database.
     */
    private function haveIntersections($activity)
    {
        $intersection = $this->activityRepository->getIntersection($activity);

        return sizeOf($intersection);
    }
}
