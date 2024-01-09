<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Team;
use App\Models\Member; 

use Database\Factories\MemberFactory;
use Database\Factories\TeamFactory;
use Database\Factories\ProjectFactory;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    private $teamsBaseRoute = '/api/teams';
    private $membersBaseRoute = '/api/members';
    private $projectsBaseRoute = '/api/projects'; 

    public function test_can_create_project()
    {
        $data = [
            'name' => 'Sample Project',
        ];

        $response = $this->json('POST', $this->projectsBaseRoute, $data);

        $response->assertStatus(201)
                 ->assertJson(['name' => 'Sample Project', ]);

        $this->assertDatabaseHas('projects', $data);
    }

    public function test_can_update_project()
    {
        $project = Project::factory()->create(['name' => 'alphaProject']);

        $data = [
            'name' => 'Updated Project Name',

        ];

        $response = $this->json('PUT', "{$this->projectsBaseRoute}/{$project->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Project Name','id' => $project->id ]);

        $this->assertDatabaseHas('projects', $data);
    }

    public function test_can_delete_project()
    {
        $project = Project::factory()->create(['name' => 'alphaProject']);

        $response = $this->json('DELETE', "{$this->projectsBaseRoute}/{$project->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_can_index_projects()
    {
        $projects = Project::factory()->count(3)->create();

        $response = $this->json('GET', '/allprojects');

        $response->assertStatus(200)
                 ->assertJsonCount(3);

        foreach ($projects as $project) {
            $response->assertJsonFragment(['id' => $project->id, 'name' => $project->name ]);
        }
    }

    public function test_can_show_project()
    {
        $project = Project::factory()->create(['name' => 'alphaProject']);

        $response = $this->json('GET', "{$this->projectsBaseRoute}/{$project->id}");

        $response->assertStatus(200)
                 ->assertJson( ['id' => $project->id, 'name' => $project->name]);
    }
    public function test_can_add_member_to_project()
    {
        $team = Team::factory()->create(['name' => 'alpha']);
        $member = Member::factory()->create(['team_id' => $team->id]);
        $project = Project::factory()->create(['name' => 'alphaProject']);

        $response = $this->json('PUT', "{$this->projectsBaseRoute}/{$project->id}/add-member/{$member->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment( ['member_id' => $member->id]);
    }
    public function test_can_show_members_associated_to_project()
    {
        $team = Team::factory()->create(['name' => 'alpha']);
        $member = Member::factory()->create(['team_id' => $team->id]);
        $project = Project::factory()->create(['name' => 'alphaProject']);
        $project->members()->attach($member);
        $response = $this->json('GET', "{$this->projectsBaseRoute}/{$project->id}/members/");

        $response->assertStatus(200)
                 ->assertJsonFragment( ['member_id' => $member->id]);
    }
}
