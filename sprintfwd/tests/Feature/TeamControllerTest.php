<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\TeamFactory;
use App\Models\Team;
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
        $team = Team::factory()->create(['name' => 'alpha']);

        $data = [
            'name' => 'Updated Team Name',
        ];

        $response = $this->json('PUT', "{$this->baseRoute}/{$team->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Team Name']);

        $this->assertDatabaseHas('teams', $data);
    }

    public function test_can_delete_team()
    {
        $team = Team::factory()->create(['name' => 'alpha']);

        $response = $this->json('DELETE', "{$this->baseRoute}/{$team->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('teams', ['id' => $team->id]);
    }

    public function test_can_index_teams()
    {
        $teams = Team::factory()->count(3)->create();

        $response = $this->json('GET', $this->baseRoute);

        $response->assertStatus(200)
                 ->assertJsonCount(3); 

        foreach ($teams as $team) {
            $response->assertJsonFragment(['id' => $team->id, 'name' => $team->name]);
        }
    }

    public function test_can_show_team()
    {
        $team = Team::factory()->create(['name' => 'alpha']);

        $response = $this->json('GET', "{$this->baseRoute}/{$team->id}");

        $response->assertStatus(200)
                 ->assertJson( ['id' => $team->id, 'name' => $team->name]);
    }
}
