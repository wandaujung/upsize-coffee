<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::create([
            'name' => 'Indoor Room',
            'capacity' => 20,
            'description' => 'Ruangan indoor dengan suasana nyaman untuk berkumpul dan bekerja.',
            'image' => 'indoor.jpg'
        ]);


        Room::create([
            'name' => 'Outdoor Room',
            'capacity' => 15,
            'description' => 'Area outdoor dengan suasana santai dan pemandangan terbuka.',
            'image' => 'outdoor.jpg'
        ]);


        Room::create([
            'name' => 'VIP Room',
            'capacity' => 10,
            'description' => 'Ruangan khusus dengan suasana lebih privat dan nyaman.',
            'image' => 'vip.jpg'
        ]);
    }
}