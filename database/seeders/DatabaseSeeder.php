<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(ContactUserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(InstituteSeeder::class);

        $this->call(InstituteUserSeeder::class);
    }
}
