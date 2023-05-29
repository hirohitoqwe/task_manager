<?php

namespace Tests\Feature;


use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class SectionTest extends TestCase
{
    public function test_create_section()
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $response = $this->post('/api/section/create', ['section_name' => 'test']);
        $response->assertStatus(201);
    }

    public function test_section_by_user()// and section by user not isset, because we dont created his
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $response = $this->get("api/section/{$user->id}");
        $response->assertStatus(404);
    }

    public function test_section_by_user_2()//section isset
    {
        $user = User::factory()->create()->first();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $section = Section::factory()->create(['user_id' => $user->id]);
        $response = $this->get("/api/section/{$user->id}");
        $response->assertStatus(200);
        $response = $this->get("/api/section/getTask/{$section->id}");
        $response->assertStatus(200);
    }

}
