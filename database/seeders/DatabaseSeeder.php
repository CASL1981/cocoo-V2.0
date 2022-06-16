<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('profile_photo');
        Storage::makeDirectory('profile_photo');
                
        
        User::factory(10)->create()->each(function($u){
            Profile::create(['user_id' => $u->id]);
        });

        $this->call(UserSeeder::class);
    }
}
