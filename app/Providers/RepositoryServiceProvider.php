<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Http\Controllers';
    protected $repository_namespace = 'App\Repositories';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            $this->repository_namespace . '\Interfaces\EWalletRepositoryInterface',
            $this->repository_namespace . '\EWalletRepository'
        );

        $this->app->bind(
            $this->repository_namespace . '\Interfaces\PackageRepositoryInterface',
            $this->repository_namespace . '\PackageRepository'
        );

        $this->app->bind(
            $this->repository_namespace . '\Interfaces\OtpRepositoryInterface',
            $this->repository_namespace . '\OtpRepository'
        );

        $this->app->bind(
            $this->repository_namespace . '\Interfaces\UserRepositoryInterface',
            $this->repository_namespace . '\UserRepository'
        );

        $this->app->bind(
            $this->repository_namespace . '\Interfaces\BannerRepositoryInterface',
            $this->repository_namespace . '\BannerRepository'
        );  
        
        $this->app->bind(
            $this->repository_namespace . '\Interfaces\BonusPoolRepositoryInterface',
            $this->repository_namespace . '\BonusPoolRepository'
        );   

        $this->app->bind(
            $this->repository_namespace . '\Interfaces\BankRepositoryInterface',
            $this->repository_namespace . '\BankRepository'
        );  

        $this->app->bind(
            $this->repository_namespace . '\Interfaces\ImportRecordRepositoryInterface',
            $this->repository_namespace . '\ImportRecordRepository'
        );  

        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
