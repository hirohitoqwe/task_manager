<?php

namespace Tests\Feature;

use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class sectionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_section()
    {
        $user = \App\Models\User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $response = $this->post('/api/section/create', ['section_name' => 'test']);
        $response->assertStatus(201);
    }

}
