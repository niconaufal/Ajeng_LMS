<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(MatapelajaranSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(SesiSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(BankSoalSeeder::class);
        $this->call(JenisUjianSeeder::class);
        $this->call(PaketSeeder::class);
        $this->call(AdminLogPermissionSeeder::class);

        //Role are automatically created when admin created

        //$this->call(GiveRoleSeeder::class);


        // Optional 

        $count = (int) $this->command->ask('Berapa banyak sample ruangan yang ingin dibuat?', 3);
        $this->command->info('Membuat ' . $count . ' ruangan');

        factory(App\Ruangan::class, $count)->create();

        $count = (int) $this->command->ask('Berapa banyak sample pengumuman yang ingin dibuat?', 10);
        $this->command->info('Membuat ' . $count . ' pengumuman');

        factory(App\Pengumuman::class, $count)->create();
    }
}
