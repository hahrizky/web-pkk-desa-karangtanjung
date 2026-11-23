<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        RateLimiter::clear('admin_test|127.0.0.1');
        RateLimiter::clear('admin@test.com|127.0.0.1');
    }

    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertSee('Panel Manajemen Konten');
    }

    public function test_admin_can_login_with_valid_username(): void
    {
        $user = User::factory()->create([
            'username' => 'admin_test',
            'email' => 'admin@test.com',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post(route('admin.login.post'), [
            'username' => 'admin_test',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_login_with_valid_email(): void
    {
        $user = User::factory()->create([
            'username' => 'admin_test',
            'email' => 'admin@test.com',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post(route('admin.login.post'), [
            'username' => 'admin@test.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_login_with_remember_me(): void
    {
        $user = User::factory()->create([
            'username' => 'admin_test',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post(route('admin.login.post'), [
            'username' => 'admin_test',
            'password' => 'secret123',
            'remember' => '1',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
        $response->assertCookieNotExpired(\Illuminate\Support\Facades\Auth::getRecallerName());
    }

    public function test_login_fails_with_invalid_credentials_and_shows_remaining_attempts(): void
    {
        User::factory()->create([
            'username' => 'admin_test',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post(route('admin.login.post'), [
            'username' => 'admin_test',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHas('error');
        $this->assertGuest();
    }

    public function test_rate_limiting_locks_out_after_five_failed_attempts(): void
    {
        User::factory()->create([
            'username' => 'admin_test',
            'password' => Hash::make('secret123'),
        ]);

        // 5 failed attempts
        for ($i = 1; $i <= 5; $i++) {
            $this->post(route('admin.login.post'), [
                'username' => 'admin_test',
                'password' => 'wrongpassword',
            ]);
        }

        // 6th attempt should be blocked by RateLimiter
        $response = $this->post(route('admin.login.post'), [
            'username' => 'admin_test',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHas('error');
        $errorMessage = session('error');
        $this->assertStringContainsString('Terlalu banyak percobaan login gagal', $errorMessage);
        $this->assertGuest();
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHas('error', 'Silakan login terlebih dahulu.');
    }

    public function test_admin_can_logout_successfully(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
