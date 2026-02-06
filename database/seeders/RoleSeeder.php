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
            // === System-level roles (independent of any institute/branch)
            ['name_en' => 'Newbie',         'name_fa' => 'تازه وارد',       'scope' => 'system',    'color' => 'slate',      'is_active' => true],
            ['name_en' => 'SuperAdmin',     'name_fa' => 'سوپر ادمین',      'scope' => 'system',    'color' => 'red',       'is_active' => true],
            ['name_en' => 'Employer',       'name_fa' => 'کارفرما',         'scope' => 'system',    'color' => 'cyan',    'is_active' => true],
            ['name_en' => 'JobSeeker',      'name_fa' => 'کارجو',           'scope' => 'system',    'color' => 'emerald',    'is_active' => true],
            ['name_en' => 'Examiner',       'name_fa' => 'آزمونگر',         'scope' => 'system',    'color' => 'yellow',    'is_active' => true],
            ['name_en' => 'Examinee',       'name_fa' => 'آزمون دهنده',     'scope' => 'system',    'color' => 'sky',    'is_active' => true],
            ['name_en' => 'QuestionMaker',  'name_fa' => 'طراح سوال',       'scope' => 'system',    'color' => 'purple',    'is_active' => true],
            ['name_en' => 'QuestionAuditor', 'name_fa' => 'ممیز سوال',      'scope' => 'system',    'color' => 'violet',    'is_active' => true],

            // === Institute-level roles
            ['name_en' => 'Founder',        'name_fa' => 'موسس',            'scope' => 'institute', 'color' => 'indigo',      'is_active' => true],

            // === Branch-level roles
            ['name_en' => 'Manager',        'name_fa' => 'مدیر',            'scope' => 'branch',    'color' => 'indigo',      'is_active' => true],
            ['name_en' => 'Assistant',      'name_fa' => 'مسئول اداری',     'scope' => 'branch',    'color' => 'fuchsia',   'is_active' => true],
            ['name_en' => 'Accountant',     'name_fa' => 'حسابدار',         'scope' => 'branch',    'color' => 'orange',    'is_active' => true],
            ['name_en' => 'Teacher',        'name_fa' => 'مربی',            'scope' => 'branch',    'color' => 'amber',     'is_active' => true],
            ['name_en' => 'Student',        'name_fa' => 'کارآموز',         'scope' => 'branch',    'color' => 'lime',      'is_active' => true],

            ['name_en' => 'Marketer',       'name_fa' => 'بازاریاب',        'scope' => 'branch',    'color' => 'green',    'is_active' => true],

        ];
        foreach ($roles as $data) {
            Role::create($data);
        }
    }
}
