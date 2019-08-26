<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Carbon\Carbon;
use App\Traits\ValidateTrait;
use App\Contracts\Activity\ActivityContract;

class ActivitiesController extends Controller
{
    use ValidateTrait;

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
    public function index()
    {
        return $this->activityRepository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = $request->all();

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
    public function update(Request $request, $id)
    {
        $activity = $request->all();

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
     * Validate if the activity object is valid.
     */
    private function validateActivity($activity)
    {
        $now = strtotime('now');

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'start_date' => 'required|date_format:Y-m-d H:i|after:' . $now . '|before:deadline',
            'deadline' => 'required|date_format:Y-m-d H:i|after:start_date',
            'end_date' => 'nullable|date_format:Y-m-d H:i',
            'user_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
        ];

        $validator = Validator::make($activity, $rules);

        if ($validator->fails()) {
            response()->json($validator->errors(), 422)->send();
            die();
        }

        if ($this->isWeekend($activity)) {
            response()->json('You can\'t register any date in weekends.', 422)->send();
            die();
        }

        if ($this->haveIntersections($activity)) {
            response()->json('You already have an activity in this time range', 422)->send();
            die();
        }
    }

    /**
     * Validate if any of the dates are in weekend.
     */
    private function isWeekend($activity)
    {
        $start_date = Carbon::createFromFormat('Y-m-d H:i', $activity['start_date']);
        $deadline = Carbon::createFromFormat('Y-m-d H:i', $activity['deadline']);

        if (isset($activity['end_date'])) {
            $end_date = Carbon::createFromFormat('Y-m-d H:i', $activity['end_date']);

            return $start_date->isWeekend() || $deadline->isWeekend() || $end_date->isWeekend();
        }

        return $start_date->isWeekend() || $deadline->isWeekend();
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
