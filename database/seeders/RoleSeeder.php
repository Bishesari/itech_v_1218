<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['slug' => 'Newbie',         'name' => 'تازه وارد',       'scope' => 'system',    'color' => 'slate',      'is_active' => true],
            ['slug' => 'SuperAdmin',     'name' => 'سوپر ادمین',      'scope' => 'system',    'color' => 'red',       'is_active' => true],
            ['slug' => 'Founder',        'name' => 'موسس',            'scope' => 'institute', 'color' => 'indigo',      'is_active' => true],
            ['slug' => 'Manager',        'name' => 'مدیر',            'scope' => 'branch',    'color' => 'indigo',      'is_active' => true],
            ['slug' => 'Assistant',      'name' => 'مسئول اداری',     'scope' => 'branch',    'color' => 'fuchsia',   'is_active' => true],
            ['slug' => 'Accountant',     'name' => 'حسابدار',         'scope' => 'branch',    'color' => 'orange',    'is_active' => true],
            ['slug' => 'Teacher',        'name' => 'مربی',            'scope' => 'branch',    'color' => 'amber',     'is_active' => true],
            ['slug' => 'Student',        'name' => 'کارآموز',         'scope' => 'branch',    'color' => 'lime',      'is_active' => true],
            ['slug' => 'QuestionMaker',  'name' => 'طراح سوال',       'scope' => 'system',    'color' => 'purple',    'is_active' => true],
            ['slug' => 'QuestionAuditor', 'name' => 'ممیز سوال',      'scope' => 'system',    'color' => 'violet',    'is_active' => true],
            ['slug' => 'Examiner',       'name' => 'آزمونگر',         'scope' => 'system',    'color' => 'yellow',    'is_active' => true],
            ['slug' => 'Marketer',       'name' => 'بازاریاب',        'scope' => 'branch',    'color' => 'green',    'is_active' => true],
            ['slug' => 'JobSeeker',      'name' => 'کارجو',           'scope' => 'system',    'color' => 'emerald',    'is_active' => true],
            ['slug' => 'Examinee',       'name' => 'آزمون دهنده',     'scope' => 'system',    'color' => 'sky',    'is_active' => true],
            ['slug' => 'Employer',       'name' => 'کارفرما',         'scope' => 'system',    'color' => 'cyan',    'is_active' => true],
        ];
        foreach ($roles as $data) {
            Role::create($data);
        }
    }
}
