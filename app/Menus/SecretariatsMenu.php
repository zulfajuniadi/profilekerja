<?php

namespace App\Menus;

use App\Libraries\Menu\BaseMenu;
use App\Http\Controllers\SecretariatsController;

class SecretariatsMenu extends BaseMenu
{

    protected $controller = SecretariatsController::class;

    public function index($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('SecretariatsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('secretariats.secretariats'))
            ;
        $this->menu->handler('secretariats.panel-buttons')
            ->addClass('pull-right')
            ->addItemIf($this->check('show', [$params['occupations']], 'App\Http\Controllers\OccupationsController'), action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name, 'btn btn-default')
            ->addItemIf($this->check('create', [$params['occupations']]), action('SecretariatsController@create', ['occupations' => $params['occupations']->getSlug()]), trans('secretariats.create'), 'btn btn-primary')
            ;
    }

    public function create($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('SecretariatsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('secretariats.secretariats'))
            ->addItem(action('SecretariatsController@create', ['occupations' => $params['occupations']->getSlug()]), trans('secretariats.create'))
            ;
        $this->menu->handler('secretariats.panel-buttons.create')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('SecretariatsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('secretariats.list_all'), 'btn btn-primary')
            ;
    }

    public function show($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('SecretariatsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('secretariats.secretariats'))
            ->addItem(action('SecretariatsController@show', ['occupations' => $params['occupations']->getSlug(), 'secretariats' => $params['secretariats']->getSlug()]), $params['secretariats']->name)
            ;
        $this->menu->handler('secretariats.panel-buttons.show')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('SecretariatsController@index', [$params['occupations']->getSlug()]), trans('secretariats.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('create', [$params['occupations']]), action('SecretariatsController@create', [$params['occupations']->getSlug()]), trans('secretariats.create'), 'btn btn-default')
            ;
        $this->menu->handler('secretariats.record-buttons.show')
            ->addItemIf($this->check('edit', [$params['occupations'], $params['secretariats']]), action('SecretariatsController@edit', [$params['occupations']->getSlug(), $params['secretariats']->getSlug()]), trans('secretariats.edit'), 'btn btn-primary')
            ->addItemIf($this->check('revisions', [$params['occupations'], $params['secretariats']]), action('SecretariatsController@revisions', [$params['occupations']->getSlug(), $params['secretariats']->getSlug()]), trans('secretariats.revisions'), 'btn btn-default')
            ->addItemIf($this->check('duplicate', [$params['occupations'], $params['secretariats']]), action('SecretariatsController@duplicate', [$params['occupations']->getSlug(), $params['secretariats']->getSlug()]),  trans('secretariats.duplicate'), 'btn btn-default')
            ->addItemIf($this->check('delete', [$params['occupations'], $params['secretariats']]), action('SecretariatsController@delete', [$params['occupations']->getSlug(), $params['secretariats']->getSlug()]), trans('secretariats.delete'), 'btn btn-danger confirm-action')
            ;
    }

    public function edit($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('SecretariatsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('secretariats.secretariats'))
            ->addItem(action('SecretariatsController@show', ['occupations' => $params['occupations']->getSlug(), 'secretariats' => $params['secretariats']->getSlug()]), $params['secretariats']->name)
            ;
        $this->menu->handler('secretariats.panel-buttons.edit')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('SecretariatsController@index', [$params['occupations']->getSlug()]), trans('secretariats.list_all'), 'btn btn-primary')
            ;
        $this->menu->handler('secretariats.record-buttons.edit')
            ->addItemIf($this->check('show', [$params['occupations'], $params['secretariats']]), action('SecretariatsController@show', [$params['occupations']->getSlug(), $params['secretariats']->getSlug()]), trans('secretariats.show'), 'btn btn-default')
            ;
    }

    public function revisions($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('SecretariatsController@index', ['occupations' => $params['occupations']->getSlug()]), trans('secretariats.secretariats'))
            ->addItem(action('SecretariatsController@show', ['occupations' => $params['occupations']->getSlug(), 'secretariats' => $params['secretariats']->getSlug()]), $params['secretariats']->name)
            ->addItem(action('SecretariatsController@revisions', [$params['occupations']->getSlug(), $params['secretariats']->getSlug()]), trans('secretariats.revisions'))
            ;
        $this->menu->handler('secretariats.panel-buttons.revisions')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('SecretariatsController@index', [$params['occupations']->getSlug()]), trans('secretariats.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('show', [$params['occupations'], $params['secretariats']]), action('SecretariatsController@show', [$params['occupations']->getSlug(), $params['secretariats']->getSlug()]), trans('secretariats.show'), 'btn btn-default')
            ;
    }

    public function __construct()
    {
        parent::__construct();
    }

}