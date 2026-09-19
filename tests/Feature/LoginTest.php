<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('user can login', function () {

    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);


    $response = $this
        ->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);


    $response
        ->assertRedirect('/dashboard');


    $this->assertAuthenticatedAs($user);

});