<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});


test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    // Pastikan pengguna berhasil dibuat di database
    $user = User::where('email', 'test@example.com')->first();
    $this->assertNotNull($user);

    // Pastikan pengguna tidak langsung login
    $this->assertGuest();

    // Pastikan diarahkan ke halaman utama
    $response->assertRedirect('/');
});
