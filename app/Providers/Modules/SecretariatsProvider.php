<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Booted\BootedTrait;
use App\Secretariat;

class SecretariatsProvider extends ServiceProvider
{

    use BootedTrait;

    protected $controller = 'App\Http\Controllers\SecretariatsController';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBootedTrait();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // register policies
        app('policy')->register($this->controller, 'App\Policies\SecretariatsPolicy');

        // register validations
        app('validation')->register($this->controller, 'App\Validators\SecretariatsValidators');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router){
            $router->bind('secretariats', function($slug) {
                if(!$secretariat = (Secretariat::whereSlug($slug)->first() ?: Secretariat::find($slug)))
                    app()->abort(404);
                return $secretariat;
            });
            $router->get('occupations/{occupations}/secretariats/data', 'SecretariatsController@data');
            $router->get('occupations/{occupations}/secretariats/{secretariats}/duplicate', 'SecretariatsController@duplicate');
            $router->get('occupations/{occupations}/secretariats/{secretariats}/delete', 'SecretariatsController@delete');
            $router->get('occupations/{occupations}/secretariats/{secretariats}/revisions', 'SecretariatsController@revisions');
            $router->resource('occupations/{occupations}/secretariats', 'SecretariatsController');
        });
    }

    public function booted()
    {
        // register menus
        app('menu')->register($this->controller, 'App\Menus\SecretariatsMenu');
    }


}
