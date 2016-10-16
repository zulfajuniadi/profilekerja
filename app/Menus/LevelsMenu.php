<?php

namespace App\Menus;

use App\Libraries\Menu\BaseMenu;
use App\Http\Controllers\LevelsController;

class LevelsMenu extends BaseMenu
{

    protected $controller = LevelsController::class;

    public function index($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('LevelsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('levels.levels'))
            ;
        $this->menu->handler('levels.panel-buttons')
            ->addClass('pull-right')
            ->addItemIf($this->check('show', [$params['occupations']], 'App\Http\Controllers\OccupationsController'), action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name, 'btn btn-default')
            ->addItemIf($this->check('create', [$params['occupations']]), action('LevelsController@create', ['occupations' => $params['occupations']->getSlug()]), trans('levels.create'), 'btn btn-primary')
            ;
    }

    public function create($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('LevelsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('levels.levels'))
            ->addItem(action('LevelsController@create', ['occupations' => $params['occupations']->getSlug()]), trans('levels.create'))
            ;
        $this->menu->handler('levels.panel-buttons.create')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('LevelsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('levels.list_all'), 'btn btn-primary')
            ;
    }

    public function show($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('LevelsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('levels.levels'))
            ->addItem(action('LevelsController@show', ['occupations' => $params['occupations']->getSlug(), 'levels' => $params['levels']->getSlug()]), $params['levels']->name)
            ;
        $this->menu->handler('levels.panel-buttons.show')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('LevelsController@index', [$params['occupations']->getSlug()]), trans('levels.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('create', [$params['occupations']]), action('LevelsController@create', [$params['occupations']->getSlug()]), trans('levels.create'), 'btn btn-default')
            ;
        $this->menu->handler('levels.record-buttons.show')
            ->addItemIf($this->check('edit', [$params['occupations'], $params['levels']]), action('LevelsController@edit', [$params['occupations']->getSlug(), $params['levels']->getSlug()]), trans('levels.edit'), 'btn btn-primary')
            ->addItemIf($this->check('revisions', [$params['occupations'], $params['levels']]), action('LevelsController@revisions', [$params['occupations']->getSlug(), $params['levels']->getSlug()]), trans('levels.revisions'), 'btn btn-default')
            ->addItemIf($this->check('duplicate', [$params['occupations'], $params['levels']]), action('LevelsController@duplicate', [$params['occupations']->getSlug(), $params['levels']->getSlug()]),  trans('levels.duplicate'), 'btn btn-default')
            ->addItemIf($this->check('delete', [$params['occupations'], $params['levels']]), action('LevelsController@delete', [$params['occupations']->getSlug(), $params['levels']->getSlug()]), trans('levels.delete'), 'btn btn-danger confirm-action')
            ;
    }

    public function edit($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('LevelsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('levels.levels'))
            ->addItem(action('LevelsController@show', ['occupations' => $params['occupations']->getSlug(), 'levels' => $params['levels']->getSlug()]), $params['levels']->name)
            ;
        $this->menu->handler('levels.panel-buttons.edit')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('LevelsController@index', [$params['occupations']->getSlug()]), trans('levels.list_all'), 'btn btn-primary')
            ;
        $this->menu->handler('levels.record-buttons.edit')
            ->addItemIf($this->check('show', [$params['occupations'], $params['levels']]), action('LevelsController@show', [$params['occupations']->getSlug(), $params['levels']->getSlug()]), trans('levels.show'), 'btn btn-default')
            ;
    }

    public function revisions($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('LevelsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('levels.levels'))
            ->addItem(action('LevelsController@show', ['occupations' => $params['occupations']->getSlug(), 'levels' => $params['levels']->getSlug()]), $params['levels']->name)
            ->addItem(action('LevelsController@revisions', [$params['occupations']->getSlug(), $params['levels']->getSlug()]), trans('levels.revisions'))
            ;
        $this->menu->handler('levels.panel-buttons.revisions')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('LevelsController@index', [$params['occupations']->getSlug()]), trans('levels.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('show', [$params['occupations'], $params['levels']]), action('LevelsController@show', [$params['occupations']->getSlug(), $params['levels']->getSlug()]), trans('levels.show'), 'btn btn-default')
            ;
    }

    public function __construct()
    {
        parent::__construct();
    }

}