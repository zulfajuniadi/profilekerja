<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Level;
use App\Occupation;
use App\Repositories\LevelsRepository;
use Illuminate\Http\Request;
use yajra\Datatables\Html\Builder;

class LevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $htmlBuilder, Occupation $occupation)
    {
        $DataTable = $htmlBuilder
        // ->addColumn(['data' => 'occupation_id', 'name' => 'occupation_id', 'title' => trans('levels.occupation_id')])
        ->addColumn(['data' => 'level', 'name' => 'level', 'title' => trans('levels.level')])
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => trans('levels.name')])
            ->ajax(action('LevelsController@data', ['occupations' => $occupation->getSlug()]));
        return view()->make('levels.index', compact('DataTable', 'occupation'));
    }

    /**
     * Data listing of the resource for DataTables.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Occupation $occupation)
    {
        return app('datatables')
            ->of(Level::where('occupation_id', $occupation->id))
            ->editColumn('name', function ($level) use ($occupation) {
                if (app('policy')->check('App\Http\Controllers\LevelsController', 'show', [$occupation, $level])) {
                    return link_to_action('LevelsController@show', $level->name, [$occupation->getSlug(), $level->getSlug()]);
                }
                return $level->name;
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
        return view()->make('levels.create', compact('occupation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Occupation $occupation)
    {
        $data = $request->all();
        $data['occupation_id'] = $occupation->id;
        $level = LevelsRepository::create(new Level, $data);
        $occupation->touch();
        return redirect()
            ->action('LevelsController@index', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('levels.created', ['name' => $level->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation, Level $level)
    {
        return view()->make('levels.show', compact('occupation', 'level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation, Level $level)
    {
        return view()->make('levels.edit', compact('occupation', 'level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation, Level $level)
    {
        $data = $request->all();
        $level = LevelsRepository::update($level, $data);
        $occupation->touch();
        return redirect()
            ->action('LevelsController@edit', ['occupations' => $occupation->getSlug(), 'levels' => $level->getSlug()])
            ->with('success', trans('levels.updated', ['name' => $level->name]));
    }

    /**
     * Duplicates the specified resource.
     *
     * @param  Level  $level
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Occupation $occupation, Level $level)
    {
        $level->name = $level->name . '-' . str_random(4);
        $level = LevelsRepository::duplicate($level);
        $occupation->touch();
        return redirect()
            ->action('LevelsController@edit', ['occupations' => $occupation->getSlug(), 'levels' => $level->getSlug()])
            ->with('success', trans('levels.created', ['name' => $level->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation, Level $level)
    {
        LevelsRepository::delete($level);
        $occupation->touch();
        return redirect()
            ->action('LevelsController@index', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('levels.deleted', ['name' => $level->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Level  $level
     * @return \Illuminate\Http\Response
     */
    public function delete(Occupation $occupation, Level $level)
    {
        return $this->destroy($occupation, $level);
    }

    /**
     * Displays the revisions of the specified resource.
     *
     * @param  Level  $level
     * @return \Illuminate\Http\Response
     */
    public function revisions(Occupation $occupation, Level $level)
    {
        return view()->make('levels.revisions', compact('occupation', 'level'));
    }

    public function __construct()
    {
        $this->middleware('title');
        $this->middleware('menu');
        $this->middleware('policy');
        $this->middleware('validate');
    }
}
