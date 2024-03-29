<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(1);
       
        $modules = [
            'destination',
            'employee',
            'client',
            'payment',
            'classification',
            'product',
            'typeprice',
            'price',
            'operation',
            'sequence',
            'detailoperation',
        ];

        //CRUD
        $permissions = [
            'create',
            'read',
            'update',
            'delete',
            'toggle',
            'process',
            'reverse'
        ];

        
        foreach($modules as $rol){            
            foreach($permissions as $per){                
                Permission::create(['name' => "{$rol} $per"]);
            }            
        }        
                
        $admin->syncPermissions(Permission::all()); 
    }
}
