<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Booted\BootedTrait;
use App\CommitteeMember;

class CommitteeMembersProvider extends ServiceProvider
{

    use BootedTrait;

    protected $controller = 'App\Http\Controllers\CommitteeMembersController';

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
        app('policy')->register($this->controller, 'App\Policies\CommitteeMembersPolicy');

        // register validations
        app('validation')->register($this->controller, 'App\Validators\CommitteeMembersValidators');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router){
            $router->bind('committee_members', function($slug) {
                if(!$committeeMember = (CommitteeMember::whereSlug($slug)->first() ?: CommitteeMember::find($slug)))
                    app()->abort(404);
                return $committeeMember;
            });
            $router->get('occupations/{occupations}/committee-members/data', 'CommitteeMembersController@data');
            $router->get('occupations/{occupations}/committee-members/{committee_members}/duplicate', 'CommitteeMembersController@duplicate');
            $router->get('occupations/{occupations}/committee-members/{committee_members}/delete', 'CommitteeMembersController@delete');
            $router->get('occupations/{occupations}/committee-members/{committee_members}/revisions', 'CommitteeMembersController@revisions');
            $router->resource('occupations/{occupations}/committee-members', 'CommitteeMembersController');
        });
    }

    public function booted()
    {
        // register menus
        app('menu')->register($this->controller, 'App\Menus\CommitteeMembersMenu');
    }


}
