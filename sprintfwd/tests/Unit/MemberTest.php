<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Member;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_member()
    {
        $team = Team::factory()->create();

        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'team_id' =>  $team->id
        ];

        $member = Member::create($data);

        $this->assertInstanceOf(Member::class, $member);
        $this->assertEquals('John', $member->first_name);
        $this->assertEquals('Doe', $member->last_name);
        $this->assertEquals('City', $member->city);
        $this->assertEquals('State', $member->state);
        $this->assertEquals('Country', $member->country);
        $this->assertEquals($team->id, $member->team_id);
    }

    public function test_it_belongs_to_team()
    {
        $team = Team::factory()->create();
        $member = Member::factory()->create(['team_id' => $team->id]);

        $this->assertInstanceOf(Team::class, $member->team);
        $this->assertEquals($team->id, $member->team->id);
    }

    public function test_it_can_be_assigned_to_multiple_projects()
    {
        $team = Team::factory()->create();
        $member = Member::factory()->create(['team_id' => $team->id]);
        $project1 = Project::factory()->create();
        $project2 = Project::factory()->create();

        $member->projects()->attach([$project1->id, $project2->id]);

        $projectIds = $member->projects()->pluck('projects.id')->toArray();
        $this->assertCount(2, $member->projects);
        $this->assertContains($project1->id,$projectIds);
        $this->assertContains($project2->id,$projectIds);
    }

    public function test_it_can_be_removed_from_project()
    {
        $team = Team::factory()->create();
        $member = Member::factory()->create(['team_id' => $team->id]);
        $project = Project::factory()->create();

        $member->projects()->attach($project->id);

        $this->assertCount(1, $member->projects);

        $member->projects()->detach($project->id);

        $this->assertCount(0, $member->fresh()->projects);
    }
}
