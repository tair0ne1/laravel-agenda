<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Get all users.
     *
     * @return void
     */
    public function testGetAllUsersTest()
    {
        $responseStructure = [
            [
                'id',
                'name',
                'created_at',
                'updated_at'
            ],
        ];

        $response = $this->get('/api/users');

        $response->assertStatus(200);

        $response->assertJsonStructure($responseStructure);
    }
}
