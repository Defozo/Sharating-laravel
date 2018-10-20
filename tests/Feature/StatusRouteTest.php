<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusRouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_status_route()
    {
        $response = $this->get('/api/status');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'online' => true,
            'version' => config('app.version'),
        ]);
    }
}
