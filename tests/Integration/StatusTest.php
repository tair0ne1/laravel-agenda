<?php

namespace Tests\Feature;

use Tests\TestCase;

class StatusTest extends TestCase
{
    /**
     * Get all statuses.
     *
     * @return void
     */
    public function testGetAllStatusesTest()
    {
        $responseStructure = [
            [
                'id',
                'name',
                'created_at',
                'updated_at'
            ],
        ];

        $response = $this->get('/api/status');

        $response->assertStatus(200);

        $response->assertJsonStructure($responseStructure);
    }
}
