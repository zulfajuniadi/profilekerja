<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Booted\BootedTrait;
use App\Level;

class LevelsProvider extends ServiceProvider
{

    use BootedTrait;

    protected $controller = 'App\Http\Controllers\LevelsController';

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
        app('policy')->register($this->controller, 'App\Policies\LevelsPolicy');

        // register validations
        app('validation')->register($this->controller, 'App\Validators\LevelsValidators');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router){
            $router->bind('levels', function($slug) {
                if(!$level = (Level::whereSlug($slug)->first() ?: Level::find($slug)))
                    app()->abort(404);
                return $level;
            });
            $router->get('occupations/{occupations}/levels/data', 'LevelsController@data');
            $router->get('occupations/{occupations}/levels/{levels}/duplicate', 'LevelsController@duplicate');
            $router->get('occupations/{occupations}/levels/{levels}/delete', 'LevelsController@delete');
            $router->get('occupations/{occupations}/levels/{levels}/revisions', 'LevelsController@revisions');
            $router->resource('occupations/{occupations}/levels', 'LevelsController');
        });
    }

    public function booted()
    {
        // register menus
        app('menu')->register($this->controller, 'App\Menus\LevelsMenu');
    }


}
