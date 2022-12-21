<?php

namespace Tests\Feature\User;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_access_their_dashboard()
    {
        $user = User::factory()->create([
            'role' => Role::user()
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'))->assertStatus(200);
    }
}
