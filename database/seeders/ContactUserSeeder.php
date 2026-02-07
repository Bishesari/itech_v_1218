<?php

namespace Database\Seeders;

use App\Models\ContactUser;
use Illuminate\Database\Seeder;

class ContactUserSeeder extends Seeder
{
    public function run(): void
    {
        $contactUser = [
            ['user_id' => 1, 'contact_id' => 1, 'is_primary' => true],
            ['user_id' => 1, 'contact_id' => 2],
            ['user_id' => 2, 'contact_id' => 3, 'is_primary' => true],
            ['user_id' => 2, 'contact_id' => 4],
            ['user_id' => 3, 'contact_id' => 5, 'is_primary' => true],
        ];
        foreach ($contactUser as $contact) {
            ContactUser::create($contact);
        }
    }
}
