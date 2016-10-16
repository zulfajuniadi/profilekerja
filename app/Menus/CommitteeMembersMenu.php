<?php

namespace App\Menus;

use App\Libraries\Menu\BaseMenu;
use App\Http\Controllers\CommitteeMembersController;

class CommitteeMembersMenu extends BaseMenu
{

    protected $controller = CommitteeMembersController::class;

    public function index($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('CommitteeMembersController@index', ['occupations' => $params['occupations']->getSlug()]), trans('committee-members.committee_members'))
            ;
        $this->menu->handler('committee-members.panel-buttons')
            ->addClass('pull-right')
            ->addItemIf($this->check('show', [$params['occupations']], 'App\Http\Controllers\OccupationsController'), action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name, 'btn btn-default')
            ->addItemIf($this->check('create', [$params['occupations']]), action('CommitteeMembersController@create', ['occupations' => $params['occupations']->getSlug()]), trans('committee-members.create'), 'btn btn-primary')
            ;
    }

    public function create($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('CommitteeMembersController@index', ['occupations' => $params['occupations']->getSlug()]), trans('committee-members.committee_members'))
            ->addItem(action('CommitteeMembersController@create', ['occupations' => $params['occupations']->getSlug()]), trans('committee-members.create'))
            ;
        $this->menu->handler('committee-members.panel-buttons.create')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('CommitteeMembersController@index', ['occupations' => $params['occupations']->getSlug()]), trans('committee-members.list_all'), 'btn btn-primary')
            ;
    }

    public function show($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('CommitteeMembersController@index', ['occupations' => $params['occupations']->getSlug()]), trans('committee-members.committee_members'))
            ->addItem(action('CommitteeMembersController@show', ['occupations' => $params['occupations']->getSlug(), 'committee_members' => $params['committee_members']->getSlug()]), $params['committee_members']->name)
            ;
        $this->menu->handler('committee-members.panel-buttons.show')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('CommitteeMembersController@index', [$params['occupations']->getSlug()]), trans('committee-members.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('create', [$params['occupations']]), action('CommitteeMembersController@create', [$params['occupations']->getSlug()]), trans('committee-members.create'), 'btn btn-default')
            ;
        $this->menu->handler('committee-members.record-buttons.show')
            ->addItemIf($this->check('edit', [$params['occupations'], $params['committee_members']]), action('CommitteeMembersController@edit', [$params['occupations']->getSlug(), $params['committee_members']->getSlug()]), trans('committee-members.edit'), 'btn btn-primary')
            ->addItemIf($this->check('revisions', [$params['occupations'], $params['committee_members']]), action('CommitteeMembersController@revisions', [$params['occupations']->getSlug(), $params['committee_members']->getSlug()]), trans('committee-members.revisions'), 'btn btn-default')
            ->addItemIf($this->check('duplicate', [$params['occupations'], $params['committee_members']]), action('CommitteeMembersController@duplicate', [$params['occupations']->getSlug(), $params['committee_members']->getSlug()]),  trans('committee-members.duplicate'), 'btn btn-default')
            ->addItemIf($this->check('delete', [$params['occupations'], $params['committee_members']]), action('CommitteeMembersController@delete', [$params['occupations']->getSlug(), $params['committee_members']->getSlug()]), trans('committee-members.delete'), 'btn btn-danger confirm-action')
            ;
    }

    public function edit($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('CommitteeMembersController@index', ['occupations' => $params['occupations']->getSlug()]), trans('committee-members.committee_members'))
            ->addItem(action('CommitteeMembersController@show', ['occupations' => $params['occupations']->getSlug(), 'committee_members' => $params['committee_members']->getSlug()]), $params['committee_members']->name)
            ;
        $this->menu->handler('committee-members.panel-buttons.edit')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('CommitteeMembersController@index', [$params['occupations']->getSlug()]), trans('committee-members.list_all'), 'btn btn-primary')
            ;
        $this->menu->handler('committee-members.record-buttons.edit')
            ->addItemIf($this->check('show', [$params['occupations'], $params['committee_members']]), action('CommitteeMembersController@show', [$params['occupations']->getSlug(), $params['committee_members']->getSlug()]), trans('committee-members.show'), 'btn btn-default')
            ;
    }

    public function revisions($params)
    {
        $this->menu->handler('breadcrumbs')
            ->addItem(action('OccupationsController@index'), trans('occupations.occupations'))
            ->addItem(action('OccupationsController@show', ['occupations' => $params['occupations']->getSlug()]), $params['occupations']->name)
            ->addItem(action('CommitteeMembersController@index', ['occupations' => $params['occupations']->getSlug()]), trans('committee-members.committee_members'))
            ->addItem(action('CommitteeMembersController@show', ['occupations' => $params['occupations']->getSlug(), 'committee_members' => $params['committee_members']->getSlug()]), $params['committee_members']->name)
            ->addItem(action('CommitteeMembersController@revisions', [$params['occupations']->getSlug(), $params['committee_members']->getSlug()]), trans('committee-members.revisions'))
            ;
        $this->menu->handler('committee-members.panel-buttons.revisions')
            ->addClass('pull-right')
            ->addItemIf($this->check('index', [$params['occupations']]), action('CommitteeMembersController@index', [$params['occupations']->getSlug()]), trans('committee-members.list_all'), 'btn btn-primary')
            ->addItemIf($this->check('show', [$params['occupations'], $params['committee_members']]), action('CommitteeMembersController@show', [$params['occupations']->getSlug(), $params['committee_members']->getSlug()]), trans('committee-members.show'), 'btn btn-default')
            ;
    }

    public function __construct()
    {
        parent::__construct();
    }

}