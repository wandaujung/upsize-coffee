<?php

use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('user can create booking', function () {

    $user = User::factory()->create();


    $room = Room::create([
        'name' => 'Indoor Room',
        'capacity' => 20,
        'description' => 'Ruangan nyaman',
    ]);


    $response = $this
        ->actingAs($user)
        ->post('/booking', [

            'name' => 'Test User',
            'room_id' => $room->id,
            'booking_date' => '2026-09-20',
            'booking_time' => '10:00',
            'people' => 5,

        ]);


    $response->assertRedirect();


    $this->assertDatabaseHas('bookings', [

        'name' => 'Test User',
        'room_id' => $room->id,
        'status' => 'pending',

    ]);

});