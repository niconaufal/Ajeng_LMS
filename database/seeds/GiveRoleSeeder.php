<?php

use App\Admin;
use App\Role;
use Illuminate\Database\Seeder;

class GiveRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $guruRole = Role::where('slug', 'guru')->first();

        $superAdminUser = Admin::where('email', 'admin@cbtexam.com')->first();
        $guruUser = Admin::where('email', 'susilawati@cbtexam.com')->first();

        $superAdminUser->roles()->attach($adminRole);
        $guruUser->roles()->attach($guruRole);
    }
}
