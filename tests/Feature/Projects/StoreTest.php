<?php

namespace Tests\Feature\Projects;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'owner_id' => $user->id,
        ];

        $this->post(route('projects.store'), $attributes)
            ->assertRedirectToRoute('projects.index');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get(route('projects.index'))->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title_and_description()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $attributes = [
            'title' => null,
            'description' => null,
        ];

        $this->post(route('projects.store'), $attributes)
            ->assertSessionHasErrors(['title', 'description']);

        $this->assertDatabaseMissing('projects', $attributes);
    }

    /** @test */
    public function a_project_requires_a_title_and_description_with_the_correct_length()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $attributes = [
            'title' => 'title',
            'description' => 'short',
        ];

        $this->post(route('projects.store'), $attributes)
            ->assertSessionHasErrors(['title', 'description']);

        $this->assertDatabaseMissing('projects', $attributes);
    }

    /** @test */
    public function a_user_must_be_logged_in_to_store_post()
    {
        $user = User::factory()->create();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'owner_id' => $user->id,
        ];

        $this->post(route('projects.store'), $attributes)
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('projects', $attributes);
    }
}
