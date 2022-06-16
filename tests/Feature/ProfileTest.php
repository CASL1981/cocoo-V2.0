<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /** @test */
    public function it_creates_a_profile_for_a_user_using_a_factory()
    {
        $user = User::factory()->create();

        $profile = Profile::factory()
            ->forUser($user)
            ->create();
        
        $this->assertInstanceOf(Profile::class, $profile);

        $this->assertEquals(
            $user->getKey(),
            $profile->user->getKey()
        );
    }

    /** @test */
    public function a_user_can_have_a_profile()
    {
        $profile = Profile::factory()
            ->forUser($user = User::factory()->create())
            ->create();

        $this->assertInstanceOf(Profile::class, $profile);

        $this->assertEquals(
            $profile->getKey(),
            $user->profile->getKey()
        );
    }

    /** @test */
    public function a_profile_has_a_bio()
    {
        $profile = Profile::factory()
            ->forUser($user = User::factory()->create())
            ->withBio($bio = 'Lorem ipsum')
            ->create();

        $this->assertInstanceOf(Profile::class, $profile);

        $this->assertEquals(
            $bio,
            $profile->bio,
        );
    }
    
    /** @test */
    public function a_profile_has_a_identification()
    {
        $profile = Profile::factory()
            ->forUser($user = User::factory()->create())
            ->withIdentification($bio = '123456789')
            ->create();

        $this->assertInstanceOf(Profile::class, $profile);

        $this->assertEquals(
            $bio,
            $profile->bio,
        );
    }
    // -------------------
    /**
     * la página de perfil contiene un componente de perfil 
     * @test */
    function profile_page_contains_profile_component()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
        ->get(route('dashboard.profile'))
        ->assertSuccessful()
        ->assertSeeLivewire('profiles');
    }

    /** 
     * se redirige si ya se ha cerrado la sesión
     * @test */
    public function is_redirected_if_already_logged_out()
    {
        $this->get(route('dashboard.profile'))
        ->assertRedirect('/login');
    }

    /** 
     * son datos de perfil precargados
     * @test */
    public function is_profile_data_pre_populated()
    {
        $firstname = 'Carlos';
        $lastname = 'Sibaja';
        $email = 'casl@yahoo.com';

        $user = User::factory()->create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
        ]);        

        Livewire::actingAs($user)
        ->test('profiles')
        ->assertSet('firstname', $firstname)
        ->assertSet('lastname', $lastname)
        ->assertSet('email', $email);
    }

    /** 
     * el mensaje se muestra al guardar
     * @test */
    // public function message_is_shown_on_save()
    // {
    //     $name = 'John Doe';
    //     $email = 'john@doe.com';

    //     $user = factory(User::class)->create([
    //         'name' => $name,
    //         'email' => $email,
    //     ]);

    //     Livewire::actingAs($user)
    //     ->test('profile')
    //     ->assertDontSee('Successfuly saved!')
    //     ->call('save')
    //     ->assertSee('Successfuly saved!');
    // }

    /** 
     * el nombre tiene un máximo de 24 caracteres
     * @test */
    // public function name_is_maximum_of_24_characters()
    // {
    //     $user = factory(User::class)->create();

    //     $name = 'This name contains more than 24 characters';

    //     Livewire::actingAs($user)
    //     ->test('profile')
    //     ->set('name', $name)
    //     ->assertHasErrors(['name' => 'max']);
    // }

    /** 
     * los datos han cambiado
     * @test */
    // public function data_has_changed()
    // {
    //     $user = factory(User::class)->create();

    //     $name = 'John Doe';
    //     $email = 'john@doe.com';

    //     Livewire::actingAs($user)
    //     ->test('profile')
    //     ->set('name', $name)
    //     ->set('email', $email)
    //     ->call('save')
    //     ->assertHasNoErrors();

    //     $nameFromDb = auth()->user()->name;
    //     $emailFromDb = auth()->user()->email;

    //     $this->assertEquals($name, $nameFromDb);
    //     $this->assertEquals($email, $emailFromDb);

    // }

    /** 
     * se redirige si el usuario ha cerrado la sesión
     * @test */
    // public function is_redirected_if_user_has_logged_out()
    // {
    //     $user = factory(User::class)->create();

    //     Livewire::actingAs($user)
    //     ->test('profile')
    //     ->call('logout')
    //     ->assertRedirect('/');
    // }
}
