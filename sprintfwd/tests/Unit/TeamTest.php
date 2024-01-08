<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Team;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_team()
    {
        $data = [
            'name' => 'Sample Team',
        ];

        $team = Team::create($data);

        $this->assertInstanceOf(Team::class, $team);
        $this->assertEquals('Sample Team', $team->name);
    }

    public function test_it_can_have_members()
    {
        $team = Team::factory()->create();
        $member1 = Member::factory()->create(['team_id' => $team->id]);
        $member2 = Member::factory()->create(['team_id' => $team->id]);


        $team->members()->saveMany([$member1, $member2]);
        $memberIds = $team->members()->pluck('id')->toArray();
        $this->assertCount(2, $team->members);
        $this->assertContains($member1->id,$memberIds);
        $this->assertContains($member2->id,$memberIds);
    }

    public function test_it_can_update_team()
    {
        $team = Team::factory()->create();

        $data = [
            'name' => 'Updated Team',
        ];

        $team->update($data);

        $this->assertEquals('Updated Team', $team->fresh()->name);
    }

    public function test_it_can_delete_team()
    {
        $team = Team::factory()->create();

        $team->delete();

        $this->assertDatabaseMissing('teams',['name'=>$team->name,'id'=> $team->id]);
    }

    public function test_it_can_get_members()
    {
        $team = Team::factory()->create();
        $member1 = Member::factory()->create(['team_id' => $team->id]);
        $member2 = Member::factory()->create(['team_id' => $team->id]);

        $memberIds = $team->members()->pluck('id')->toArray();
        $this->assertCount(2, $team->members);
        $this->assertContains($member1->id,$memberIds);
        $this->assertContains($member2->id,$memberIds);

    }
}
