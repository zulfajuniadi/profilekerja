<?php

namespace App\Menus;

use App\Http\Controllers\DutiesController;
use App\Libraries\Menu\BaseMenu;

class DutiesMenu extends BaseMenu
{

    protected $controller = DutiesController::class;

    public function index($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('DutiesController@index', ['occupations' => $params['occupations']->getSlug()]), trans('duties.duties'))
        ;
        $this->menu->handler('duties.panel-buttons')
            ->addClass('pull-right')
            ->addItemIf($this->check('show', [$params['occupations']], 'App\Http\Controllers\OccupationsController'), action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name, 'btn btn-default')
        // ->addItemIf($this->check('create', [$params['occupations']]), action('DutiesController@create', ['occupations' => $params['occupations']->getSlug()]), trans('duties.create'), 'btn btn-primary')
        ;
    }

    public function create($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('DutiesController@index', ['occupations' => $params['occupations']->getSlug()]), trans('duties.duties'))
            ->addItem(action('DutiesController@create', ['occupations' => $params['occupations']->getSlug()]), trans('duties.create'))
        ;
        $this->menu->handler('duties.panel-buttons.create')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('DutiesController@index', ['occupations' => $params['occupations']->getSlug()]), trans('duties.list_all'), 'btn btn-primary')
        ;
    }

    public function show($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('DutiesController@index', ['occupations' => $params['occupations']->getSlug()]), trans('duties.duties'))
            ->addItem(action('DutiesController@show', ['occupations' => $params['occupations']->getSlug(), 'duties' => $params['duties']->getSlug()]), $params['duties']->name)
        ;
        $this->menu->handler('duties.panel-buttons.show')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('DutiesController@index', [$params['occupations']->getSlug()]), trans('duties.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('create', [$params['occupations']]), action('DutiesController@create', [$params['occupations']->getSlug()]), trans('duties.create'), 'btn btn-default')
        ;
        $this->menu->handler('duties.record-buttons.show')
            ->addItemIf($this->check('edit', [$params['occupations'], $params['duties']]), action('DutiesController@edit', [$params['occupations']->getSlug(), $params['duties']->getSlug()]), trans('duties.edit'), 'btn btn-primary')
            ->addItemIf($this->check('revisions', [$params['occupations'], $params['duties']]), action('DutiesController@revisions', [$params['occupations']->getSlug(), $params['duties']->getSlug()]), trans('duties.revisions'), 'btn btn-default')
            ->addItemIf($this->check('duplicate', [$params['occupations'], $params['duties']]), action('DutiesController@duplicate', [$params['occupations']->getSlug(), $params['duties']->getSlug()]), trans('duties.duplicate'), 'btn btn-default')
            ->addItemIf($this->check('delete', [$params['occupations'], $params['duties']]), action('DutiesController@delete', [$params['occupations']->getSlug(), $params['duties']->getSlug()]), trans('duties.delete'), 'btn btn-danger confirm-action')
        ;
    }

    public function edit($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('DutiesController@index', ['occupations' => $params['occupations']->getSlug()]), trans('duties.duties'))
            ->addItem(action('DutiesController@show', ['occupations' => $params['occupations']->getSlug(), 'duties' => $params['duties']->getSlug()]), $params['duties']->name)
        ;
        $this->menu->handler('duties.panel-buttons.edit')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('DutiesController@index', [$params['occupations']->getSlug()]), trans('duties.list_all'), 'btn btn-primary')
        ;
        $this->menu->handler('duties.record-buttons.edit')
            ->addItemIf($this->check('show', [$params['occupations'], $params['duties']]), action('DutiesController@show', [$params['occupations']->getSlug(), $params['duties']->getSlug()]), trans('duties.show'), 'btn btn-default')
        ;
    }

    public function revisions($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('DutiesController@index', ['occupations' => $params['occupations']->getSlug()]), trans('duties.duties'))
            ->addItem(action('DutiesController@show', ['occupations' => $params['occupations']->getSlug(), 'duties' => $params['duties']->getSlug()]), $params['duties']->name)
            ->addItem(action('DutiesController@revisions', [$params['occupations']->getSlug(), $params['duties']->getSlug()]), trans('duties.revisions'))
        ;
        $this->menu->handler('duties.panel-buttons.revisions')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('DutiesController@index', [$params['occupations']->getSlug()]), trans('duties.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('show', [$params['occupations'], $params['duties']]), action('DutiesController@show', [$params['occupations']->getSlug(), $params['duties']->getSlug()]), trans('duties.show'), 'btn btn-default')
        ;
    }

    public function __construct()
    {
        parent::__construct();
    }

}
