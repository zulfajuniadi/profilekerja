<?php

namespace App\Menus;

use App\Http\Controllers\TasksController;
use App\Libraries\Menu\BaseMenu;

class TasksMenu extends BaseMenu
{

    protected $controller = TasksController::class;

    public function index($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('DutiesController@index'), trans('duties.duties'))
            ->addItem(action('DutiesController@show', ['duties' => $params['duties']->getSlug()]), $params['duties']->name)
            ->addItem(action('TasksController@index', ['duties' => $params['duties']->getSlug()]), trans('tasks.tasks'))
        ;
        $this->menu->handler('tasks.panel-buttons')
            ->addClass('pull-right')
            ->addItemIf($this->check('show', [$params['duties']], 'App\Http\Controllers\DutiesController'), action('DutiesController@show', ['duties' => $params['duties']->getSlug()]), $params['duties']->name, 'btn btn-default')
            ->addItemIf($this->check('create', [$params['duties']]), action('TasksController@create', ['duties' => $params['duties']->getSlug()]), trans('tasks.create'), 'btn btn-primary')
        ;
    }

    public function create($params)
    {
        // $this->menu->handler('breadcrumbs')
        //     ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
        //     ->addItem(action('OccupationsController@show', ['occupations' => $params['duties']->occupation->getSlug()]), $params['duties']->occupation->name)
        //     ->addItem(action('DutiesController@index', ['occupations' => $params['duties']->occupation->getSlug()]), trans('duties.duties'))
        //     ->addItem(action('DutiesController@show', ['occupations' => $params['duties']->occupation->getSlug(), 'duties' => $params['duties']->getSlug()]), $params['duties']->name)
        //     ->addItem(action('TasksController@index', ['duties' => $params['duties']->getSlug()]), trans('tasks.tasks'))
        //     ->addItem(action('TasksController@create', ['duties' => $params['duties']->getSlug()]), trans('tasks.create'))
        // ;
        $this->menu->handler('tasks.panel-buttons.create')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['duties']]), action('DutiesController@index', [$params['duties']->occupation->getSlug()]), $params['duties']->occupation->name, 'btn btn-primary')
        ;
    }

    public function show($params)
    {
        // $this->menu->handler('breadcrumbs')
        //     ->addItem(action('DutiesController@index'), trans('duties.duties'))
        //     ->addItem(action('DutiesController@show', ['duties' => $params['duties']->getSlug()]), $params['duties']->name)
        //     ->addItem(action('TasksController@index', ['duties' => $params['duties']->getSlug()]), trans('tasks.tasks'))
        //     ->addItem(action('TasksController@show', ['duties' => $params['duties']->getSlug(), 'tasks' => $params['tasks']->getSlug()]), $params['tasks']->name)
        // ;
        $this->menu->handler('tasks.panel-buttons.show')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['duties']]), action('DutiesController@index', [$params['duties']->occupation->getSlug()]), trans('duties.duties'), 'btn btn-primary')
        // ->addItemIf($this->check('create', [$params['duties']]), action('TasksController@create', [$params['duties']->getSlug()]), trans('tasks.create'), 'btn btn-default')
        ;
        $this->menu->handler('tasks.record-buttons.show')
            ->addItemIf($this->check('edit', [$params['duties'], $params['tasks']]), action('TasksController@edit', [$params['duties']->getSlug(), $params['tasks']->getSlug()]), trans('tasks.edit'), 'btn btn-primary')
        // ->addItemIf($this->check('revisions', [$params['duties'], $params['tasks']]), action('TasksController@revisions', [$params['duties']->getSlug(), $params['tasks']->getSlug()]), trans('tasks.revisions'), 'btn btn-default')
        // ->addItemIf($this->check('duplicate', [$params['duties'], $params['tasks']]), action('TasksController@duplicate', [$params['duties']->getSlug(), $params['tasks']->getSlug()]), trans('tasks.duplicate'), 'btn btn-default')
            ->addItemIf($this->check('delete', [$params['duties'], $params['tasks']]), action('TasksController@delete', [$params['duties']->getSlug(), $params['tasks']->getSlug()]), trans('tasks.delete'), 'btn btn-danger confirm-action')
        ;
    }

    public function edit($params)
    {
        $this->menu->handler('tasks.panel-buttons.edit')
            ->addClass('pull-right')
            ->addItemIf($this->check('show', [$params['duties'], $params['tasks']]), action('TasksController@show', [$params['duties']->getSlug(), $params['tasks']->getSlug()]), 'Back', 'btn btn-default')
        ;
    }

    public function revisions($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('DutiesController@index'), trans('duties.duties'))
            ->addItem(action('DutiesController@show', ['duties' => $params['duties']->getSlug()]), $params['duties']->name)
            ->addItem(action('TasksController@index', ['duties' => $params['duties']->getSlug()]), trans('tasks.tasks'))
            ->addItem(action('TasksController@show', ['duties' => $params['duties']->getSlug(), 'tasks' => $params['tasks']->getSlug()]), $params['tasks']->name)
            ->addItem(action('TasksController@revisions', [$params['duties']->getSlug(), $params['tasks']->getSlug()]), trans('tasks.revisions'))
        ;
        $this->menu->handler('tasks.panel-buttons.revisions')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['duties']]), action('TasksController@index', [$params['duties']->getSlug()]), trans('tasks.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('show', [$params['duties'], $params['tasks']]), action('TasksController@show', [$params['duties']->getSlug(), $params['tasks']->getSlug()]), trans('tasks.show'), 'btn btn-default')
        ;
    }

    public function __construct()
    {
        parent::__construct();
    }

}
