<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activity;
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
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required',
            'deadline' => 'required',
            'end_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
        ];

        if (!$this->validate($request, $rules)) {
            return response()->json(['Invalid JSON Object.'], 422);
        }

        return $request->all();

        $activity = new Activity($request->all());

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
        $activity = new Activity($request->all());

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
}
