<?php

namespace Tests\Feature\Projects;

use App\Enums\Role;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guest_cannot_view_projects()
    {
        $this->get(route('projects.index'))
            ->assertRedirectToRoute('login');
    }

    /** @test */
    public function admin_can_view_all_projects()
    {
        $admin = User::factory()->create([
            'role' => Role::admin()
        ]);

        $this->actingAs($admin)->get(route('projects.index'))
            ->assertStatus(200);
    }
}
