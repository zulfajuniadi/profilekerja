<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Booted\BootedTrait;
use App\Task;

class TasksProvider extends ServiceProvider
{

    use BootedTrait;

    protected $controller = 'App\Http\Controllers\TasksController';

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
        app('policy')->register($this->controller, 'App\Policies\TasksPolicy');

        // register validations
        app('validation')->register($this->controller, 'App\Validators\TasksValidators');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router){
            $router->bind('tasks', function($slug) {
                if(!$task = (Task::whereSlug($slug)->first() ?: Task::find($slug)))
                    app()->abort(404);
                return $task;
            });
            $router->get('duties/{duties}/tasks/data', 'TasksController@data');
            $router->get('duties/{duties}/tasks/{tasks}/duplicate', 'TasksController@duplicate');
            $router->get('duties/{duties}/tasks/{tasks}/delete', 'TasksController@delete');
            $router->get('duties/{duties}/tasks/{tasks}/revisions', 'TasksController@revisions');
            $router->resource('duties/{duties}/tasks', 'TasksController');
        });
    }

    public function booted()
    {
        // register menus
        app('menu')->register($this->controller, 'App\Menus\TasksMenu');
    }


}
