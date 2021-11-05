<?php

use App\Admin;
use App\Permission;
use Illuminate\Database\Seeder;

class AdminLogPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('email', 'admin@cbtexam.com')->first();

        $admin->givePermissionsTo('hapus-log');
    }
}
