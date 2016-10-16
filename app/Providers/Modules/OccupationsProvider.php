<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Booted\BootedTrait;
use App\Occupation;

class OccupationsProvider extends ServiceProvider
{

    use BootedTrait;

    protected $controller = 'App\Http\Controllers\OccupationsController';

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
        app('policy')->register($this->controller, 'App\Policies\OccupationsPolicy');

        // register validations
        app('validation')->register($this->controller, 'App\Validators\OccupationsValidators');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router){
            $router->bind('occupations', function($slug) {
                if(!$occupation = (Occupation::whereSlug($slug)->first() ?: Occupation::find($slug)))
                    app()->abort(404);
                return $occupation;
            });
            $router->get('occupations/data', 'OccupationsController@data');
            $router->get('occupations/{occupations}/duplicate', 'OccupationsController@duplicate');
            $router->get('occupations/{occupations}/delete', 'OccupationsController@delete');
            $router->get('occupations/{occupations}/revisions', 'OccupationsController@revisions');
            $router->resource('occupations', 'OccupationsController');
        });
    }

    public function booted()
    {
        // register menus
        app('menu')->register($this->controller, 'App\Menus\OccupationsMenu');
    }


}
