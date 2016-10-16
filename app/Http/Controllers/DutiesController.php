<?php

namespace App\Http\Controllers;

use App\Duty;
use App\Http\Controllers\Controller;
use App\Occupation;
use App\Repositories\DutiesRepository;
use Illuminate\Http\Request;
use yajra\Datatables\Html\Builder;

class DutiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $htmlBuilder, Occupation $occupation)
    {
        $occupation->load('duties', 'duties.tasks');
        return view()->make('duties.index', compact('occupation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Occupation $occupation)
    {
        return view()->make('duties.create', compact('occupation'));
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
        $duty = DutiesRepository::create(new Duty, $data);
        $occupation->touch();
        return redirect()
            ->action('DutiesController@index', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('duties.created', ['name' => $duty->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  Duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation, Duty $duty)
    {
        return view()->make('duties.show', compact('occupation', 'duty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation, Duty $duty)
    {
        return view()->make('duties.edit', compact('occupation', 'duty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation, Duty $duty)
    {
        $data = $request->all();
        $duty = DutiesRepository::update($duty, $data);
        $occupation->touch();
        return redirect()
            ->action('DutiesController@edit', ['occupations' => $occupation->getSlug(), 'duties' => $duty->getSlug()])
            ->with('success', trans('duties.updated', ['name' => $duty->name]));
    }

    /**
     * Duplicates the specified resource.
     *
     * @param  Duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Occupation $occupation, Duty $duty)
    {
        $duty->name = $duty->name . '-' . str_random(4);
        $duty = DutiesRepository::duplicate($duty);
        $occupation->touch();
        return redirect()
            ->action('DutiesController@edit', ['occupations' => $occupation->getSlug(), 'duties' => $duty->getSlug()])
            ->with('success', trans('duties.created', ['name' => $duty->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation, Duty $duty)
    {
        DutiesRepository::delete($duty);
        $occupation->touch();
        return redirect()
            ->action('DutiesController@index', ['occupations' => $occupation->getSlug()])
            ->with('success', trans('duties.deleted', ['name' => $duty->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function delete(Occupation $occupation, Duty $duty)
    {
        return $this->destroy($occupation, $duty);
    }

    /**
     * Displays the revisions of the specified resource.
     *
     * @param  Duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function revisions(Occupation $occupation, Duty $duty)
    {
        return view()->make('duties.revisions', compact('occupation', 'duty'));
    }

    public function __construct()
    {
        $this->middleware('title');
        $this->middleware('menu');
        $this->middleware('policy');
        $this->middleware('validate');
    }
}
