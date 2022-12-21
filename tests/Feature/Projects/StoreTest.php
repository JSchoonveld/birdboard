<?php

namespace Tests\Feature\Projects;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->actingAs($this->user)->get(route('projects.create'))->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'owner_id' => $this->user->id,
        ];

        $this->actingAs($this->user)->post(route('projects.store'), $attributes)
            ->assertRedirectToRoute('projects.index');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get(route('projects.index'))->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title_and_description()
    {
        $attributes = [
            'title' => null,
            'description' => null,
        ];

        $this->actingAs($this->user)->post(route('projects.store'), $attributes)
            ->assertSessionHasErrors(['title', 'description']);

        $this->assertDatabaseMissing('projects', $attributes);
    }

    /** @test */
    public function a_project_requires_a_title_and_description_with_the_correct_length()
    {
        $attributes = [
            'title' => 'title',
            'description' => 'short',
        ];

        $this->actingAs($this->user)->post(route('projects.store'), $attributes)
            ->assertSessionHasErrors(['title', 'description']);

        $this->assertDatabaseMissing('projects', $attributes);
    }

    /** @test */
    public function unauthenticated_users_cannot_create_projects()
    {
        $user = User::factory()->create();

        $this->get(route('projects.create'))->assertStatus(302);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'owner_id' => $user->id,
        ];

        $this->post(route('projects.store'), $attributes)
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('projects', $attributes);
    }

    /** @test */
    public function a_user_has_projects()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
