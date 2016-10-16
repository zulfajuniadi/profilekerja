<?php

namespace App\Menus;

use App\Http\Controllers\OccupationsController;
use App\Libraries\Menu\BaseMenu;

class OccupationsMenu extends BaseMenu
{

    protected $controller = OccupationsController::class;

    public function index($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'));
        $this->menu->handler('occupations.panel-buttons')
            ->addClass('pull-right')
            ->addItemIf($this->check('create'), action('OccupationsController@create'), trans('occupations.create'), 'btn btn-primary');
    }

    public function create($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@create'), trans('occupations.create'));
        $this->menu->handler('occupations.panel-buttons.create')
            ->addClass('pull-right')
            ->addItemIf($this->check('index'), action('OccupationsController@index'), trans('occupations.list_all'), 'btn btn-primary');
    }

    public function show($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', $params['occupations']->getSlug()), $params['occupations']->name);
        $this->menu->handler('occupations.panel-buttons.show')
            ->addClass('pull-right')
            ->addItemIf($this->check('index'), action('OccupationsController@index'), trans('occupations.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('create'), action('OccupationsController@create'), trans('occupations.create'), 'btn btn-default');
        $this->menu->handler('occupations.record-buttons.show')
        // ->addItemIf($this->check('index', $params), action('CommitteeMembersController@index', $params['occupations']->getSlug()), trans('committee-members.committee_members'), 'btn btn-primary')
        // ->addItemIf($this->check('index', $params), action('SecretariatsController@index', $params['occupations']->getSlug()), trans('secretariats.secretariats'), 'btn btn-primary')
            ->addItemIf($this->check('index', $params), action('LevelsController@index', $params['occupations']->getSlug()), trans('levels.levels'), 'btn btn-primary')
            ->addItemIf($this->check('index', $params), action('DutiesController@index', $params['occupations']->getSlug()), trans('duties.duties'), 'btn btn-primary')
            ->addItemIf($this->check('edit', $params), action('OccupationsController@edit', $params['occupations']->getSlug()), trans('occupations.edit'), 'btn btn-primary')
            ->addItemIf($this->check('revisions', $params), action('OccupationsController@revisions', $params['occupations']->getSlug()), trans('occupations.revisions'), 'btn btn-default')
            ->addItemIf($this->check('duplicate', $params), action('OccupationsController@duplicate', $params['occupations']->getSlug()), trans('occupations.duplicate'), 'btn btn-default')
            ->addItemIf($this->check('delete', $params), action('OccupationsController@delete', $params['occupations']->getSlug()), trans('occupations.delete'), 'btn btn-danger confirm-action');
    }

    public function edit($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', $params['occupations']->getSlug()), $params['occupations']->name);
        $this->menu->handler('occupations.panel-buttons.edit')
            ->addClass('pull-right')
            ->addItemIf($this->check('index'), action('OccupationsController@index'), trans('occupations.list_all'), 'btn btn-primary');
        $this->menu->handler('occupations.record-buttons.edit')
            ->addItemIf($this->check('show', [$params['occupations']]), action('OccupationsController@show', $params['occupations']->getSlug()), trans('occupations.show'), 'btn btn-default');
    }

    public function revisions($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', $params['occupations']->getSlug()), $params['occupations']->name)
            ->addItem(action('OccupationsController@revisions', $params['occupations']->getSlug()), trans('occupations.revisions'));
        $this->menu->handler('occupations.panel-buttons.revisions')
            ->addClass('pull-right')
            ->addItemIf($this->check('index'), action('OccupationsController@index'), trans('occupations.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('show', [$params['occupations']]), action('OccupationsController@show', $params['occupations']->getSlug()), trans('occupations.show'), 'btn btn-default');
    }

    public function __construct()
    {
        parent::__construct();
        $this->menu->handler('app')
            ->addItemIf($this->check('index'), action('OccupationsController@index'), trans('occupations.occupations'));
    }

}
