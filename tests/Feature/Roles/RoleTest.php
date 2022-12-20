<?php

namespace Tests\Feature\Roles;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function admin_has_the_correct_role()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'role' => Role::admin()
        ]);

        $this->assertEquals(Role::admin(), $admin->role);
    }
}
