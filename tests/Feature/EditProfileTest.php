<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

        /** @test */
        // public function it_shows_an_edit_profile_page()
        // {
        //     $this->actingAs(User::factory()->create());
    
        //     $this->get('/profile/edit')
        //         ->assertStatus(200);
        // }

        /** @test */
        // public function it_renders_a_livewire_component_on_the_edit_profile_page()
        // {
        //     $this->actingAs(User::factory()->create());

        //     $this->get('/profile/edit')
        //         ->assertSeeLivewire('profiles');
        // }
}
