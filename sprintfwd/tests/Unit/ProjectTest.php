<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Models\Member;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_project()
    {
        $data = [
            'name' => 'Sample Project',
        ];

        $project = Project::create($data);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals('Sample Project', $project->name);
    }

    public function test_it_can_have_members()
    {
        $project = Project::factory()->create();
        $team = Team::factory()->create();
        $member1 = Member::factory()->create(['team_id' => $team->id]);
        $member2 = Member::factory()->create(['team_id' => $team->id]);

        $project->members()->attach([$member1->id, $member2->id]);

        $memberIds =  $project->members()->pluck('members.id')->toArray();
        $this->assertCount(2,  $project->members);
        $this->assertContains($member1->id,$memberIds);
        $this->assertContains($member2->id,$memberIds);
    }
    

    public function test_it_can_remove_member()
    {
        $project = Project::factory()->create();
        $team = Team::factory()->create();
        $member = Member::factory()->create(['team_id' => $team->id]);

        $project->members()->attach($member->id);

        $this->assertCount(1, $project->members);

        $project->members()->detach($member->id);

        $this->assertCount(0, $project->fresh()->members);
    }

    public function test_it_can_update_project()
    {
        $project = Project::factory()->create();

        $data = [
            'name' => 'Updated Project',
        ];

        $project->update($data);

        $this->assertEquals('Updated Project', $project->fresh()->name);
    }

    public function test_it_can_delete_project()
    {
        $project = Project::factory()->create();

        $project->delete();
        $this->assertDatabaseMissing('projects',['name'=>$project->name,'id'=> $project->id]);
    }
}
