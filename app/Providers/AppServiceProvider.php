<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Http\Services\ComunidadeService;
use App\Http\Services\ComunidadeServiceInterface;
use App\Http\Services\HomeService;
use App\Http\Services\HomeServiceInterface;
use App\Http\Services\MelhoresService;
use App\Http\Services\MelhoresServiceInterface;
use App\Http\Services\NotificacaoService;
use App\Http\Services\NotificacaoServiceInterface;
use App\Http\Services\PerfilService;
use App\Http\Services\PerfilServiceInterface;
use App\Http\Services\PostsService;
use App\Http\Services\PostsServiceInterface;
use App\Http\Services\RankingService;
use App\Http\Services\RankingServiceInterface;
use App\Http\Services\SeguidoresService;
use App\Http\Services\SeguidoresServiceInterface;
use App\Http\Services\LoginService;
use App\Http\Services\LoginServiceInterface;
use App\Http\Services\CadastrarService;
use App\Http\Services\CadastrarServiceInterface;
use App\Http\Services\RecuperarSenhaService;
use App\Http\Services\RecuperarSenhaServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ComunidadeServiceInterface::class, ComunidadeService::class);
        $this->app->bind(HomeServiceInterface::class, HomeService::class);
        $this->app->bind(MelhoresServiceInterface::class, MelhoresService::class);
        $this->app->bind(NotificacaoServiceInterface::class, NotificacaoService::class);
        $this->app->bind(PerfilServiceInterface::class, PerfilService::class);
        $this->app->bind(PostsServiceInterface::class, PostsService::class);
        $this->app->bind(RankingServiceInterface::class, RankingService::class);
        $this->app->bind(SeguidoresServiceInterface::class, SeguidoresService::class);
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(CadastrarServiceInterface::class, CadastrarService::class);
        $this->app->bind(RecuperarSenhaServiceInterface::class, RecuperarSenhaService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
