<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;

    private $baseRoute = '/teams';

    public function test_can_create_team()
    {
        $data = [
            'name' => 'Sample Team',
        ];

        $response = $this->json('POST', $this->baseRoute, $data);

        $response->assertStatus(201)
                 ->assertJson(['name' => 'Sample Team', /*... other expected fields ...*/]);

        $this->assertDatabaseHas('teams', $data);
    }

    public function test_can_update_team()
    {
        $team = factory(\App\Team::class)->create();

        $data = [
            'name' => 'Updated Team Name',
        ];

        $response = $this->json('PUT', "{$this->baseRoute}/{$team->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Team Name', /*... other expected fields ...*/]);

        $this->assertDatabaseHas('teams', $data);
    }

    public function test_can_delete_team()
    {
        $team = factory(\App\Team::class)->create();

        $response = $this->json('DELETE', "{$this->baseRoute}/{$team->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('teams', ['id' => $team->id]);
    }

    public function test_can_index_teams()
    {
        $teams = factory(\App\Team::class, 3)->create();

        $response = $this->json('GET', $this->baseRoute);

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data'); // Assuming your response structure has a 'data' key

        foreach ($teams as $team) {
            $response->assertJson(['data' => [['id' => $team->id, 'name' => $team->name, /*... other fields ...*/]]]);
        }
    }

    public function test_can_show_team()
    {
        $team = factory(\App\Team::class)->create();

        $response = $this->json('GET', "{$this->baseRoute}/{$team->id}");

        $response->assertStatus(200)
                 ->assertJson(['data' => ['id' => $team->id, 'name' => $team->name, /*... other fields ...*/]]);
    }
}
