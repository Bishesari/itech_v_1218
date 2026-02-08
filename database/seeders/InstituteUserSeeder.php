<?php

namespace Database\Seeders;

use App\Models\InstituteUser;
use App\Models\Role;
use Illuminate\Database\Seeder;

class InstituteUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::where('slug', 'super_admin')->firstOrFail();

        InstituteUser::updateOrCreate(
            [
                'user_id' => 1,
                'role_id' => $superAdminRole->id,
            ],
            [
                'institute_id' => null,
                'branch_id' => null,
                'is_active' => true,
            ]
        );
    }
}
