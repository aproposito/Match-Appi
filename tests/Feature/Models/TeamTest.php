<?php

namespace Tests\Feature\Models;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_can_be_created(): void
    {
        $team = Team::factory()->create();

        $this->assertDatabaseHas('teams', ['name' => $team->name]);
    }
 public function test_team_flag_can_be_null(): void
{
    $team = Team::factory()->create(['flag' => null]);

    $this->assertNull($team->flag);
}

public function test_team_has_home_matches_relation(): void
{
    $team = Team::factory()->create();

    $this->assertInstanceOf(
        \Illuminate\Database\Eloquent\Collection::class,
        $team->homeMatches
    );
}   
}
