<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Temuan;
use App\Models\Tindakan;
use App\Models\Departement;
use App\Policies\UserPolicy;
use App\Policies\TemuanPolicy;
use App\Models\PenanggungJawab;
use App\Policies\TindakanPolicy;
use App\Policies\DepartementPolicy;
use App\Policies\PenanggungJawabPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Departement::class => DepartementPolicy::class,
        PenanggungJawab::class => PenanggungJawabPolicy::class,
        Tindakan::class => TindakanPolicy::class,
        Temuan::class => TemuanPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
