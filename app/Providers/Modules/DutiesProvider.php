<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Booted\BootedTrait;
use App\Duty;

class DutiesProvider extends ServiceProvider
{

    use BootedTrait;

    protected $controller = 'App\Http\Controllers\DutiesController';

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
        app('policy')->register($this->controller, 'App\Policies\DutiesPolicy');

        // register validations
        app('validation')->register($this->controller, 'App\Validators\DutiesValidators');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router){
            $router->bind('duties', function($slug) {
                if(!$duty = (Duty::whereSlug($slug)->first() ?: Duty::find($slug)))
                    app()->abort(404);
                return $duty;
            });
            $router->get('occupations/{occupations}/duties/data', 'DutiesController@data');
            $router->get('occupations/{occupations}/duties/{duties}/duplicate', 'DutiesController@duplicate');
            $router->get('occupations/{occupations}/duties/{duties}/delete', 'DutiesController@delete');
            $router->get('occupations/{occupations}/duties/{duties}/revisions', 'DutiesController@revisions');
            $router->resource('occupations/{occupations}/duties', 'DutiesController');
        });
    }

    public function booted()
    {
        // register menus
        app('menu')->register($this->controller, 'App\Menus\DutiesMenu');
    }


}
