<?php

namespace Tests\Feature\Projects;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post(route('projects.store'), $attributes)->assertRedirectToRoute('projects.index');

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

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors(['title', 'description']);

        $this->assertDatabaseMissing('projects', $attributes);
    }

    /** @test */
    public function a_project_requires_a_title_and_description_with_the_correct_length()
    {

        $attributes = [
            'title' => 'title',
            'description' => 'short',
        ];

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors(['title', 'description']);

        $this->assertDatabaseMissing('projects', $attributes);
    }
}
