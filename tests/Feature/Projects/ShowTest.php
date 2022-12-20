<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_view_their_project()
    {
        $user = User::factory()->create();

        $project = Project::factory()->create([
            'owner_id' => $user->id
        ]);

        $this->actingAs($user)->get(route('projects.show', $project->id))
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function unauthenticated_users_cannot_view_single_projects()
    {
        $user = User::factory()->create();

        $user->projects()->create([
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ]);

        $this->get(route('projects.show', $user->projects->first()->id))->assertRedirectToRoute('login');
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $users = User::factory()->count(2)->create();
        foreach ($users as $user) {
            $user->projects()->create([
                'title' => $this->faker->sentence(),
                'description' => $this->faker->paragraph(),
            ]);
        }

        $this->actingAs($users[0])->get(route('projects.show', $users[1]->projects->first()->id))->assertStatus(403);
    }
}
