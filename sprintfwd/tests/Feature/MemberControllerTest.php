<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Team;
use App\Models\Member; // Import the Member model
use Database\Factories\MemberFactory;
use Database\Factories\TeamFactory;
use Database\Factories\ProjectFactory;

class MemberControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker; // Add this trait
                // Register the factory
    private $teamsBaseRoute = '/teams';
    private $membersBaseRoute = '/members'; // Updated the base route
    private $projectsBaseRoute = '/projects';

    public function test_can_create_member()
    {

        $team = Team::factory()->create(['name' => 'alpha']);

        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'city' => 'New York',
            'state' => 'NY',
            'country' => 'USA',
            'team_id' => $team->id, // Use team_id instead of team
        ];

        $response = $this->json('POST', $this->membersBaseRoute, $data);

        $response->assertStatus(201)
                 ->assertJson(['first_name' => 'John', /*... other expected fields ...*/]);

        $this->assertDatabaseHas('members', $data);
    }

    public function test_can_update_member()
    {
        $team = Team::factory()->create(['name' => 'alpha']);
        $member = Member::factory()->create(['team_id' => $team->id]); // Use Member factory

        $data = [
            'first_name' => 'Updated John',
            'last_name' => 'Updated Doe',
            // ... other fields as needed
        ];

        $response = $this->json('PUT', "{$this->membersBaseRoute}/{$member->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['first_name' => 'Updated John', /*... other expected fields ...*/]);

        $this->assertDatabaseHas('members', $data);
    }
    public function test_can_delete_member()
    {
        $team = \App\Team::factory()->create(['name' => 'alpha']); // Use factory() method
        $member = factory(\App\Member::class)->create(['team_id' => $team->id]);

        $response = $this->json('DELETE', "{$this->membersBaseRoute}/{$member->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('members', ['id' => $member->id]);
    }

    public function test_can_index_members()
    {
        $team = \App\Team::factory()->create(['name' => 'alpha']); // Use factory() method
        $members = factory(\App\Member::class, 3)->create(['team_id' => $team->id]);

        $response = $this->json('GET', $this->membersBaseRoute);

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');

        foreach ($members as $member) {
            $response->assertJson(['data' => [['id' => $member->id, 'first_name' => $member->first_name, /*... other fields ...*/]]]);
        }
    }

    public function test_can_show_member()
    {
        $team = \App\Team::factory()->create(['name' => 'alpha']); // Use factory() method
        $member = factory(\App\Member::class)->create(['team_id' => $team->id]);

        $response = $this->json('GET', "{$this->membersBaseRoute}/{$member->id}");

        $response->assertStatus(200)
                 ->assertJson(['data' => ['id' => $member->id, 'first_name' => $member->first_name, /*... other fields ...*/]]);
    }
}



