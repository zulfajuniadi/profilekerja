<?php

namespace App\Http\Controllers;

use App\CommitteeMember;
use App\Http\Controllers\Controller;
use App\Occupation;
use App\Repositories\CommitteeMembersRepository;
use Illuminate\Http\Request;
use yajra\Datatables\Html\Builder;

class CommitteeMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $htmlBuilder, Occupation $occupation)
    {
        $DataTable = $htmlBuilder
        // ->addColumn(['data' => 'occupation_id', 'name' => 'occupation_id', 'title' => trans('committee-members.occupation_id')])
        ->addColumn(['data' => 'name', 'name' => 'name', 'title' => trans('committee-members.name')])
            ->addColumn(['data' => 'company', 'name' => 'company', 'title' => trans('committee-members.company')])
            ->ajax(action('CommitteeMembersController@data', ['occupations' => $occupation->getSlug()]));
        return view()->make('committee-members.index', compact('DataTable', 'occupation'));
    }

    /**
     * Data listing of the resource for DataTables.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Occupation $occupation)
    {
        return app('datatables')
            ->of(CommitteeMember::where('occupation_id', $occupation->id))
            ->editColumn('name', function ($committeeMember) use ($occupation) {
                if (app('policy')->check('App\Http\Controllers\CommitteeMembersController', 'show', [$occupation, $committeeMember])) {
                    return link_to_action('CommitteeMembersController@show', $committeeMember->name, [$occupation->getSlug(), $committeeMember->getSlug()]);
                }
                return $committeeMember->name;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Occupation $occupation)
    {
        return view()->make('committee-members.create', compact('occupation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Occupation $occupation)
    {
        $committeeMember = CommitteeMembersRepository::create(new CommitteeMember, $request->all());
        $occupation->touch();
        return redirect()
            ->action('CommitteeMembersController@index', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('committee-members.created', ['name' => $committeeMember->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  CommitteeMember  $committeeMember
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return view()->make('committee-members.show', compact('occupation', 'committeeMember'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CommitteeMember  $committeeMember
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return view()->make('committee-members.edit', compact('occupation', 'committeeMember'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  CommitteeMember  $committeeMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation, CommitteeMember $committeeMember)
    {
        $committeeMember = CommitteeMembersRepository::update($committeeMember, $request->all());
        $occupation->touch();
        return redirect()
            ->action('CommitteeMembersController@edit', ['occupations' => $occupation->getSlug(), 'committee_members' => $committeeMember->getSlug()])
            ->with('success', trans('committee-members.updated', ['name' => $committeeMember->name]));
    }

    /**
     * Duplicates the specified resource.
     *
     * @param  CommitteeMember  $committeeMember
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Occupation $occupation, CommitteeMember $committeeMember)
    {
        $committeeMember->name = $committeeMember->name . '-' . str_random(4);
        $committeeMember = CommitteeMembersRepository::duplicate($committeeMember);
        $occupation->touch();
        return redirect()
            ->action('CommitteeMembersController@edit', ['occupations' => $occupation->getSlug(), 'committee_members' => $committeeMember->getSlug()])
            ->with('success', trans('committee-members.created', ['name' => $committeeMember->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CommitteeMember  $committeeMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation, CommitteeMember $committeeMember)
    {
        CommitteeMembersRepository::delete($committeeMember);
        $occupation->touch();
        return redirect()
            ->action('CommitteeMembersController@index', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('committee-members.deleted', ['name' => $committeeMember->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CommitteeMember  $committeeMember
     * @return \Illuminate\Http\Response
     */
    public function delete(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return $this->destroy($occupation, $committeeMember);
    }

    /**
     * Displays the revisions of the specified resource.
     *
     * @param  CommitteeMember  $committeeMember
     * @return \Illuminate\Http\Response
     */
    public function revisions(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return view()->make('committee-members.revisions', compact('occupation', 'committeeMember'));
    }

    public function __construct()
    {
        $this->middleware('title');
        $this->middleware('menu');
        $this->middleware('policy');
        $this->middleware('validate');
    }
}
