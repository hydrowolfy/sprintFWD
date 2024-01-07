<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    private $teamsBaseRoute = '/teams';
    private $membersBaseRoute = '/members';
    private $projectsBaseRoute = '/projects'; 

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
        $project = factory(\App\Project::class)->create();

        $data = [
            'name' => 'Updated Project Name',

        ];

        $response = $this->json('PUT', "{$this->projectsBaseRoute}/{$project->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Project Name', ]);

        $this->assertDatabaseHas('projects', $data);
    }

    public function test_can_delete_project()
    {
        $project = factory(\App\Project::class)->create();

        $response = $this->json('DELETE', "{$this->projectsBaseRoute}/{$project->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_can_index_projects()
    {
        $projects = factory(\App\Project::class, 3)->create();

        $response = $this->json('GET', $this->projectsBaseRoute);

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');

        foreach ($projects as $project) {
            $response->assertJson(['data' => [['id' => $project->id, 'name' => $project->name ]]]);
        }
    }

    public function test_can_show_project()
    {
        $project = factory(\App\Project::class)->create();

        $response = $this->json('GET', "{$this->projectsBaseRoute}/{$project->id}");

        $response->assertStatus(200)
                 ->assertJson(['data' => ['id' => $project->id, 'name' => $project->name]]);
    }
}
