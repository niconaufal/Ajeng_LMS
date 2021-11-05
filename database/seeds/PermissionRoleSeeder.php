<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
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

        $guruPermissions = [
            'buat-soal',
            'edit-soal',
            'hapus-soal',
            'lihat-entitas',
            'lihat-nilai'
        ];
        
        $permissions = Permission::all();

        foreach($permissions as $permission) 
        {
            $permission->roles()->attach($adminRole);

            if(in_array($permission->slug, $guruPermissions)) {
                $permission->roles()->attach($guruRole);
            }
        }
    }
}
