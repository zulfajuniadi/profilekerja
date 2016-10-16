<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\OccupationsRepository;
use App\Http\Controllers\Controller;
use yajra\Datatables\Html\Builder;
use App\Occupation;

class OccupationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $htmlBuilder)
    {
        $DataTable = $htmlBuilder
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => trans('occupations.name')])
            ->ajax(action('OccupationsController@data'));
        return view()->make('occupations.index', compact('DataTable'));
    }

    /**
     * Data listing of the resource for DataTables.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        return app('datatables')
            ->of(Occupation::whereNotNull('name'))
            ->editColumn('name', function($occupation){
                if(app('policy')->check('App\Http\Controllers\OccupationsController', 'show', [$occupation])) {
                    return link_to_action('OccupationsController@show', $occupation->name, $occupation->getSlug());
                }
                return $occupation->name;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view()->make('occupations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $occupation = OccupationsRepository::create(new Occupation, $request->all());
        return redirect()
            ->action('OccupationsController@index')
            ->with('success', trans('occupations.created', ['name' => $occupation->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation)
    {
        return view()->make('occupations.show', compact('occupation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation)
    {
        return view()->make('occupations.edit', compact('occupation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation)
    {
        $occupation = OccupationsRepository::update($occupation, $request->all());
        return redirect()
            ->action('OccupationsController@edit', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('occupations.updated', ['name' => $occupation->name]));
    }

    /**
     * Duplicates the specified resource.
     *
     * @param  Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Occupation $occupation)
    {
        $occupation->name = $occupation->name . '-' . str_random(4);
        $occupation = OccupationsRepository::duplicate($occupation);
        return redirect()
            ->action('OccupationsController@edit', $occupation->getSlug())
            ->with('success', trans('occupations.created', ['name' => $occupation->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation)
    {
        OccupationsRepository::delete($occupation);
        return redirect()
            ->action('OccupationsController@index')
            ->with('success', trans('occupations.deleted', ['name' => $occupation->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function delete(Occupation $occupation)
    {
        return $this->destroy($occupation);
    }

    /**
     * Displays the revisions of the specified resource.
     *
     * @param  Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function revisions(Occupation $occupation)
    {
        return view()->make('occupations.revisions', compact('occupation'));
    }

    public function __construct()
    {
        $this->middleware('title');
        $this->middleware('menu');
        $this->middleware('policy');
        $this->middleware('validate');
    }
}
