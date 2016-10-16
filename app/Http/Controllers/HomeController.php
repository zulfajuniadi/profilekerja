<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Occupation;
use App\Task;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function getOccupations()
    {
        return Occupation::with('duties')->orderBy('name')->get();
    }

    public function getOccupation($slug)
    {
        return Occupation::findBySlug($slug)->load([
            'duties' => function ($query) {
                $query->orderBy('code');
            }, 'duties.tasks' => function ($query) {
                $query->orderBy('code');
            }, 'duties.tasks.level',
        ]);
    }

    public function getTask($slug)
    {
        return Task::findBySlug($slug)->load('level', 'duty');
    }
}
