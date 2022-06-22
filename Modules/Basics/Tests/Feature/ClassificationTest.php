<?php

namespace Modules\Basics\Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Basics\Entities\Classification;

class ClassificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function classification_creation_page_contains_livewire_component()
    {   
        $user = User::factory()->create();
        
        $this->actingAs($user)
        ->get(route('basic.classifications'))
        ->assertStatus(200)
        ->assertSeeLivewire('basics::classifications');
    }

    /** 
     * el mensaje se muestra al guardar
     * @test */
    // public function can_crete_classification_and_list_component()
    // {
    //     $code = '1100';
    //     $level = '1';
    //     $parent = '1100';
    //     $name = 'PAPELERIA';
    //     $impute = true;

    //     $user = User::factory()->create();

    //     Classification::factory()->create([
    //         'code' => $code,
    //         'level' => $level,
    //         'parent' => $parent,
    //         'name' => $name,
    //         'impute' => $impute,
    //     ]);

    //     Livewire::actingAs($user)
    //     ->test('basics::classifications')
    //     ->assertSee($code)
    //     ->assertSee($level)
    //     ->assertSee($parent)
    //     ->assertSee($name)
    //     ->assertSee($impute);
    // }

    // /** 
    //  * el mensaje se muestra al guardar
    //  * @test */
    // public function message_is_shown_on_save()
    // {
    //     $code = '1100';
    //     $level = '1';
    //     $parent = '1100';
    //     $name = 'PAPELERIA';
    //     $impute = false;

    //     $user = User::factory()->create();

    //     Livewire::actingAs($user)
    //     ->test('basics::classifications')
    //     ->set('code', $code)
    //     ->set('level', $level)
    //     ->set('parent', $parent)
    //     ->set('name', $name)
    //     ->set('impute', $impute)
    //     ->call('store')
    //     ->assertSee('Clasificación creada')
    //     ->assertSee($code)
    //     ->assertSee($level)
    //     ->assertSee($parent)
    //     ->assertSee($name)
    //     ->assertSee($impute);
    // }
    /**
    * @test
    * @dataProvider validationRules
    **/
    // public function test_validation_rules($field, $value, $rule)
    // {
    //     $user = User::factory()->create();
    //     $anotherUser = User::factory()->create(['email' => 'duplicate@email.com'])

    //     Livewire::actingAs($user)
    //         ->test(ProfileForm::class, ['user' => $user])
    //         ->set($field, $value)
    //         ->call('save')
    //         ->assertHasErrors([$field => $rule]);
    // }

    // public function validationRules()
    // {
    //     return [
    //         'name is null' => ['user.name', null, 'required'],
    //         'name is too long' => ['user.name', str_repeat('*', 201), 'max'],
    //         'email is null' => ['user.email', null, 'required'],
    //         'email is invalid' => ['user.email', 'this is not an email', 'email'],
    //         'email is not unique' => ['user.email', 'duplicate@email.com', 'unique'],
    //         'bio is null' => ['user.bio', null, 'required'],
    //         'bio is too short' => ['user.bio', str_repeat('*', 8), 'min'],
    //         'bio is too long' => ['user.bio', str_repeat('*', 1001), 'max'],
    //     ];
    // }
}
