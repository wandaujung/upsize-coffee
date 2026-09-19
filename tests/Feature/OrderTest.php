<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('user can create order from cart', function () {

    $user = User::factory()->create();


    $product = Product::create([
        'name' => 'Kopi Latte',
        'price' => 15000,
    ]);


    Cart::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'quantity' => 3,
    ]);


    $response = $this
        ->actingAs($user)
        ->post('/checkout', [

            'name' => 'Test User',

            'table_number' => 'A01',

        ]);


    $response->assertRedirect('/orders');


    $this->assertDatabaseHas('orders', [

        'user_id' => $user->id,

        'table_number' => 'A01',

        'status' => 'pending',

    ]);


    $this->assertDatabaseHas('order_items', [

        'product_id' => $product->id,

        'quantity' => 3,

    ]);

});