<?php

namespace Tests\Feature;

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
                    'status_id'
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
}
