<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\SecretariatsRepository;
use App\Http\Controllers\Controller;
use yajra\Datatables\Html\Builder;
use App\Occupation;
use App\Secretariat;

class SecretariatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $htmlBuilder, Occupation $occupation)
    {
        $DataTable = $htmlBuilder
            ->addColumn(['data' => 'occupation_id', 'name' => 'occupation_id', 'title' => trans('secretariats.occupation_id')])
            ->addColumn(['data' => 'role', 'name' => 'role', 'title' => trans('secretariats.role')])
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => trans('secretariats.name')])
            ->ajax(action('SecretariatsController@data', ['occupations' => $occupation->getSlug()]));
        return view()->make('secretariats.index', compact('DataTable', 'occupation'));
    }

    /**
     * Data listing of the resource for DataTables.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Occupation $occupation)
    {
        return app('datatables')
            ->of(Secretariat::where('occupation_id', $occupation->id))
            ->editColumn('name', function($secretariat) use ($occupation) {
                if(app('policy')->check('App\Http\Controllers\SecretariatsController', 'show', [$occupation, $secretariat])) {
                    return link_to_action('SecretariatsController@show', $secretariat->name, [$occupation->getSlug(), $secretariat->getSlug()]);
                }
                return $secretariat->name;
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
        return view()->make('secretariats.create', compact('occupation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Occupation $occupation)
    {
        $secretariat = SecretariatsRepository::create(new Secretariat, $request->all());
        $occupation->touch();
        return redirect()
            ->action('SecretariatsController@index', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('secretariats.created', ['name' => $secretariat->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  Secretariat  $secretariat
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation, Secretariat $secretariat)
    {
        return view()->make('secretariats.show', compact('occupation', 'secretariat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Secretariat  $secretariat
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation, Secretariat $secretariat)
    {
        return view()->make('secretariats.edit', compact('occupation', 'secretariat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Secretariat  $secretariat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation, Secretariat $secretariat)
    {
        $secretariat = SecretariatsRepository::update($secretariat, $request->all());
        $occupation->touch();
        return redirect()
            ->action('SecretariatsController@edit', ['occupations' => $occupation->getSlug(), 'secretariats' => $secretariat->getSlug()])
            ->with('success', trans('secretariats.updated', ['name' => $secretariat->name]));
    }

    /**
     * Duplicates the specified resource.
     *
     * @param  Secretariat  $secretariat
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Occupation $occupation, Secretariat $secretariat)
    {
        $secretariat->name = $secretariat->name . '-' . str_random(4);
        $secretariat = SecretariatsRepository::duplicate($secretariat);
        $occupation->touch();
        return redirect()
            ->action('SecretariatsController@edit', ['occupations' => $occupation->getSlug(), 'secretariats' => $secretariat->getSlug()])
            ->with('success', trans('secretariats.created', ['name' => $secretariat->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Secretariat  $secretariat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation, Secretariat $secretariat)
    {
        SecretariatsRepository::delete($secretariat);
        $occupation->touch();
        return redirect()
            ->action('SecretariatsController@index', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('secretariats.deleted', ['name' => $secretariat->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Secretariat  $secretariat
     * @return \Illuminate\Http\Response
     */
    public function delete(Occupation $occupation, Secretariat $secretariat)
    {
        return $this->destroy($occupation, $secretariat);
    }

    /**
     * Displays the revisions of the specified resource.
     *
     * @param  Secretariat  $secretariat
     * @return \Illuminate\Http\Response
     */
    public function revisions(Occupation $occupation, Secretariat $secretariat)
    {
        return view()->make('secretariats.revisions', compact('occupation', 'secretariat'));
    }

    public function __construct()
    {
        $this->middleware('title');
        $this->middleware('menu');
        $this->middleware('policy');
        $this->middleware('validate');
    }
}
