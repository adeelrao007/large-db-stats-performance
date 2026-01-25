<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    /**
     * Test the health check route returns 200.
     *
     * @return void
     */
    public function test_health_check_route_works()
    {
        $response = $this->get('/health');
        $response->assertStatus(200);
    }

    /**
     * Test the database connection is healthy.
     *
     * @return void
     */
    public function test_database_connection_is_healthy()
    {
        $this->assertTrue(DB::connection()->getPdo() !== null);
    }
}
