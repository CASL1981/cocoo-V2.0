<?php

namespace Modules\Orders\Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function product_creation_page_contains_livewire_component()
    {   
        $user = User::factory()->create();
        
        $this->actingAs($user)
        ->get(route('order.products'))
        ->assertStatus(200)
        ->assertSeeLivewire('orders::products');
    }
}
