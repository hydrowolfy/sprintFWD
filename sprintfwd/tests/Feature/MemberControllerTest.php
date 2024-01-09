<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Team;
use App\Models\Member; 

use Database\Factories\MemberFactory;
use Database\Factories\TeamFactory;
use Database\Factories\ProjectFactory;

class MemberControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker; 
    private $teamsBaseRoute = '/api/teams';
    private $membersBaseRoute = '/api/members'; 
    private $projectsBaseRoute = '/api/projects';

    public function test_can_create_member()
    {
 
        $team = Team::factory()->create(['name' => 'alpha']);

        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'city' => 'New York',
            'state' => 'NY',
            'country' => 'USA',
            'team_id' => $team->id,
        ];

        $response = $this->json('POST', $this->membersBaseRoute, $data);

        $response->assertStatus(201)
                 ->assertJson(['first_name' => 'John','last_name' => 'Doe', 'city' => 'New York','state' => 'NY','country' => 'USA','team_id' => $team->id]);

        $this->assertDatabaseHas('members', $data);
    }

    public function test_can_update_member()
    {
        $team = Team::factory()->create(['name' => 'alpha']);
        $betaTeam = Team::factory()->create(['name' => 'beta']);

        $member = Member::factory()->create(['team_id' => $team->id]); 

        $data = [
            'first_name' => 'Updated John',
            'last_name' => 'Updated Doe',
            'city' => 'Updated New York',
            'state' => 'Updated NY',
            'country' => 'Updated USA',
            'team_id' => $betaTeam->id, 
        ];

        $response = $this->json('PUT', "{$this->membersBaseRoute}/{$member->id}", $data);

        $response->assertStatus(200)
        ->assertJson(['first_name' => 'Updated John','last_name' => 'Updated Doe', 'city' => 'Updated New York','state' => 'Updated NY','country' => 'Updated USA','team_id' => $betaTeam->id]);

        $this->assertDatabaseHas('members', $data);
    }
    public function test_can_update_member_team()
    {
        $team = Team::factory()->create(['name' => 'alpha']);
        $betaTeam = Team::factory()->create(['name' => 'beta']);

        $member = Member::factory()->create(['team_id' => $team->id]); 
        $data = [
            'team_id' => $betaTeam->id, 
        ];

        $response = $this->json('PUT', "{$this->membersBaseRoute}/{$member->id}/update-team", $data);

        $response->assertStatus(200)
        ->assertJson(['team_id' => $betaTeam->id]);

        $this->assertDatabaseHas('members', $data);
    }

    public function test_can_delete_member()
    {
        $team = Team::factory()->create(['name' => 'alpha']);
        $member = Member::factory()->create(['team_id' => $team->id]);

        $response = $this->json('DELETE', "{$this->membersBaseRoute}/{$member->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('members', ['id' => $member->id]);
    }

    public function test_can_index_members()
    {
        $team = Team::factory()->create(['name' => 'alpha']);
        $members = Member::factory()->count(3)->create(['team_id' => $team->id]);
    
        $memberIds = $members->pluck('id')->toArray();
    
        $response = $this->json('GET', '/allmembers', ['member_ids' => $memberIds]);
        $response->assertStatus(200)
                 ->assertJsonCount(3);
        
        foreach ($members as $member) {
            $response->assertJsonFragment(['id' => $member->id, 'first_name' => $member->first_name,'last_name' => $member->last_name, 'city' => $member->city,'state' => $member->state,'country' => $member->country,'team_id' => $member->team_id]);
        }
    }
    

    public function test_can_show_member()
    {
        $team = Team::factory()->create(['name' => 'alpha']);
        $member = Member::factory()->create(['team_id' => $team->id]);

        $response = $this->json('GET', "{$this->membersBaseRoute}/{$member->id}");

        $response->assertStatus(200)
                 ->assertJson( ['id' => $member->id, 'first_name' => $member->first_name,'last_name' => $member->last_name, 'city' => $member->city,'state' => $member->state,'country' => $member->country,'team_id' => $member->team_id]);
    }
}



