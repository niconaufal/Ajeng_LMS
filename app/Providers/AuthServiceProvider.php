<?php

namespace App\Providers;

use App\Murid;
use App\Policies\MuridPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Murid' => 'App\Policies\MuridPolicy',
        'App\Guru' => 'App\Policies\GuruPolicy',
        'App\Matapelajaran' => 'App\Policies\MatapelajaranPolicy',
        'App\Jurusan' => 'App\Policies\JurusanPolicy',
        'App\Kelas' => 'App\Policies\KelasPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Soal' => 'App\Policies\SoalPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
