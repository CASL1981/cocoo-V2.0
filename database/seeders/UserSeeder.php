<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('profile_photo');
        $administrador = User::factory()->create([
            'email' => 'contabilidad@coodescor.org.co',
            'status' => true
        ]);

        Profile::create(['user_id' => $administrador->id]);
        
        $vendedor = User::factory()->create([
            'email' => 'vendedor@coodescor.org.co'
        ]);
        
        Profile::create(['user_id' => $vendedor->id]);
        
        $cliente = User::factory()->create([
            'email' => 'cliente@coodescor.org.co'
        ]);
        
        Profile::create(['user_id' => $cliente->id]);

        $admin = Role::create(['name' => 'administrador']);
        $seller = Role::create(['name' => 'vendedor']);
        $client = Role::create(['name' => 'cliente']);
        $role = Role::create(['name' => 'role']);

        //CRUD

        $permissions = [
            'create',
            'read',
            'update',
            'delete',
            'toggle'
        ];

        foreach(Role::all() as $rol){
            foreach($permissions as $per){
                $rol->name =='administrador' ? $rol->name = 'usuario' : $rol->name;
                Permission::create(['name' => "{$rol->name} $per"]);
            }
        }        
        
        $admin->syncPermissions(Permission::all());
        $seller->syncPermissions(Permission::where('name', 'like', '%vendedor%')->get());
        $client->syncPermissions(Permission::where('name', 'like', '%cliente%')->get());
        $role->syncPermissions(Permission::where('name', 'like', '%role%')->get());
        
        $administrador->assignRole('administrador');
        $cliente->assignRole('cliente');
        $vendedor->assignRole('vendedor');       
        
    }
}
