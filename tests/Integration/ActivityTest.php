<?php

namespace Tests\Feature;

use App\Models\Activity;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    /**
     * Get all activities.
     *
     * @return void
     */
    public function testGetAllActivitiesTest()
    {
        $responseStructure = [
            'current_page',
            'data' => [
                [
                    'title',
                    'description',
                    'start_date',
                    'deadline',
                    'end_date',
                    'user_id',
                    'status_id',
                    'user' => [
                        'id',
                        'name'
                    ],
                    'status' => [
                        'id',
                        'name'
                    ]
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ];

        $response = $this->get('/api/activities');

        $response->assertStatus(200);

        $response->assertJsonStructure($responseStructure);
    }

    /**
     * Get all activities with only Initial date
     * returning 422.
     *
     * @return void
     */
    public function testGetAllActivitiesWithInitialDateTest()
    {
        $now = Carbon::now();

        $response = $this->get('/api/activities?initial_date='.$now->subYear()->format('Y-m-d H:i'));

        $response->assertStatus(422);
    }

    /**
     * Get all activities with invalid Initial date
     * returning 422.
     *
     * @return void
     */
    public function testGetAllActivitiesWithInvalidInitialDateTest()
    {
        $now = Carbon::now();

        $response = $this->get('/api/activities?initial_date='.$now->subYear()->format('Y-m-d'));

        $response->assertStatus(422);
    }

    /**
     * Get all activities with only final date
     * returning 422.
     *
     * @return void
     */
    public function testGetAllActivitiesWithFinalDateTest()
    {
        $now = Carbon::now();

        $response = $this->get('/api/activities?final_date='.$now->addYear()->format('Y-m-d H:i'));

        $response->assertStatus(422);
    }

    /**
     * Get all activities with invalid final date
     * returning 422.
     *
     * @return void
     */
    public function testGetAllActivitiesWithInvalidFinalDateTest()
    {
        $now = Carbon::now();

        $response = $this->get('/api/activities?final_date='.$now->addYear()->format('Y-m-d'));

        $response->assertStatus(422);
    }

    /**
     * Get all activities with filters.
     *
     * @return void
     */
    public function testGetAllActivitiesWithFiltersTest()
    {
        $now = Carbon::now();

        $response = $this->get('/api/activities?initial_date='.$now->subYear()->format('Y-m-d H:i').'&final_date='.$now->addYear()->format('Y-m-d H:i'));

        $response->assertStatus(200);
    }

    // /**
    //  * Add activity
    //  *
    //  * @return void
    //  */
    // public function testAddOneActivityTest()
    // {
    //     $activity = factory(Activity::class)->make();

    //     $response = $this->post('/api/activities', $activity->toArray());

    //     $response->assertStatus(200);

    //     $responseStructure = [
    //         'title',
    //         'description',
    //         'start_date',
    //         'deadline',
    //         'end_date',
    //         'user_id',
    //         'status_id',
    //         'user' => [
    //             'id',
    //             'name'
    //         ],
    //         'status' => [
    //             'id',
    //             'name'
    //         ]
    //     ];

    //     $response->assertJsonStructure($responseStructure);
    // }

    /**
     * Add activity with failure.
     *
     * @return void
     */
    public function testAddOneActivityWithFailuresTest()
    {
        $responseStructure = [
            'title'       => ['The title field is required.'],
            'description' => ['The description field is required.'],
            'start_date'  => ['The start date field is required.'],
            'deadline'    => ['The deadline field is required.'],
            'user_id'     => ['The user id field is required.'],
            'status_id'   => ['The status id field is required.']
        ];

        $response = $this->post('/api/activities');

        $response->assertStatus(422);
        
        $response->assertJson($responseStructure);
    }

    /**
     * Get one activity
     *
     * @return void
     */
    public function testGetOneActivityTest()
    {
        $response = $this->get('/api/activities/1');

        $response->assertStatus(200);

        $responseStructure = [
            'title',
            'description',
            'start_date',
            'deadline',
            'end_date',
            'user_id',
            'status_id',
            'user' => [
                'id',
                'name'
            ],
            'status' => [
                'id',
                'name'
            ]
        ];

        $response->assertJsonStructure($responseStructure);
    }
}
