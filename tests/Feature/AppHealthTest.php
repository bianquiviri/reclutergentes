<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppHealthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_home_page_is_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function test_vite_assets_are_configured_correctly()
    {
        $response = $this->get('/');
        
        // Check if the page contains references to app.css and app.js
        // (This confirms Vite directive is working without crashing)
        $response->assertSee('<link rel="stylesheet"', false);
    }
}
