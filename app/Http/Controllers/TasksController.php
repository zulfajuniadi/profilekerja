<?php

namespace App\Http\Controllers;

use App\Duty;
use App\Http\Controllers\Controller;
use App\Repositories\TasksRepository;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Duty $duty)
    {
        return view()->make('tasks.create', compact('duty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Duty $duty)
    {
        $data = $request->all();
        $data['duty_id'] = $duty->id;
        $task = TasksRepository::create(new Task, $data);
        $duty->touch();
        return redirect()
            ->action('DutiesController@index', ['occupations' => $duty->occupation->getSlug()])
            ->with('success', trans('tasks.created', ['name' => $task->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Duty $duty, Task $task)
    {
        return view()->make('tasks.show', compact('duty', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Duty $duty, Task $task)
    {
        return view()->make('tasks.edit', compact('duty', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Duty $duty, Task $task)
    {
        $task = TasksRepository::update($task, $request->all());
        $duty->touch();
        return redirect()
            ->action('TasksController@edit', ['duties' => $duty->getSlug(), 'tasks' => $task->getSlug()])
            ->with('success', trans('tasks.updated', ['name' => $task->name]));
    }

    /**
     * Duplicates the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Duty $duty, Task $task)
    {
        $task->name = $task->name . '-' . str_random(4);
        $task = TasksRepository::duplicate($task);
        $duty->touch();
        return redirect()
            ->action('TasksController@edit', ['duties' => $duty->getSlug(), 'tasks' => $task->getSlug()])
            ->with('success', trans('tasks.created', ['name' => $task->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Duty $duty, Task $task)
    {
        TasksRepository::delete($task);
        $duty->touch();
        return redirect()
            ->action('DutiesController@index', ['duties' => $duty->occupation->getSlug()])
            ->with('success', trans('tasks.deleted', ['name' => $task->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function delete(Duty $duty, Task $task)
    {
        return $this->destroy($duty, $task);
    }

    /**
     * Displays the revisions of the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function revisions(Duty $duty, Task $task)
    {
        return view()->make('tasks.revisions', compact('duty', 'task'));
    }

    public function __construct()
    {
        $this->middleware('title');
        $this->middleware('menu');
        $this->middleware('policy');
        $this->middleware('validate');
    }
}
