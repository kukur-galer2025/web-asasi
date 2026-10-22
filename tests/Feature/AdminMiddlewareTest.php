<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test tamu yang belum login tidak bisa mengakses area admin dan diarahkan ke login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.members'));
        $response->assertRedirect(route('login'));

        $postsResponse = $this->get(route('admin.posts'));
        $postsResponse->assertRedirect(route('login'));

        $pagesResponse = $this->get(route('admin.pages'));
        $pagesResponse->assertRedirect(route('login'));
    }

    /**
     * Test user dengan role 'member' (biasa) dilarang mengakses panel admin (403 Forbidden).
     */
    public function test_regular_member_gets_403_forbidden_on_admin_routes(): void
    {
        $member = User::factory()->create([
            'role' => 'member',
        ]);

        $this->actingAs($member);

        $responseMembers = $this->get(route('admin.members'));
        $responseMembers->assertStatus(403);

        $responsePosts = $this->get(route('admin.posts'));
        $responsePosts->assertStatus(403);

        $responsePages = $this->get(route('admin.pages'));
        $responsePages->assertStatus(403);
    }

    /**
     * Test user dengan role 'admin' berhasil mengakses panel admin (200 OK).
     */
    public function test_admin_user_can_access_admin_routes(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $responseMembers = $this->get(route('admin.members'));
        $responseMembers->assertStatus(200);

        $responsePosts = $this->get(route('admin.posts'));
        $responsePosts->assertStatus(200);

        $responsePages = $this->get(route('admin.pages'));
        $responsePages->assertStatus(200);
    }
}
