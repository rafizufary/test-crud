<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class SessionTimeoutTest extends TestCase
{
    public function test_user_is_redirected_to_login_after_session_timeout()
    {
        // Buat pengguna
        $user = User::factory()->create();

        // Login pengguna
        $this->actingAs($user);

        // Simulasikan waktu sesi
        session(['last_activity' => time() - (config('session.lifetime') * 60 + 1)]);

        // Akses halaman yang dilindungi
        $response = $this->get('/dashboard');

        // Periksa pengalihan ke halaman login
        $response->assertRedirect(route('login'));

        // Periksa pesan sesi timeout
        $this->assertEquals(session('message'), 'Session timeout. Please login again.');
    }

    public function test_user_remains_logged_in_within_session_time()
    {
        // Buat pengguna
        $user = User::factory()->create();

        // Login pengguna
        $this->actingAs($user);

        // Simulasikan waktu sesi
        session(['last_activity' => time()]);

        // Akses halaman yang dilindungi
        $response = $this->get('/home');

        // Periksa status berhasil
        $response->assertStatus(200);
    }
}
