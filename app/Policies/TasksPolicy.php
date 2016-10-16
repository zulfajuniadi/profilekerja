<?php

namespace App\Policies;

use App\Task;
use App\Duty;
use App\Libraries\Policy\BasePolicy;

class TasksPolicy extends BasePolicy
{
    public function index(Duty $duty)
    {
        return $this->user->ability(['Admin'], ['Task:List']);
    }

    public function data(Duty $duty)
    {
        return $this->index($duty);
    }

    public function show(Duty $duty, Task $task)
    {
        return $this->user->ability(['Admin'], ['Task:Show']);
    }

    public function create(Duty $duty)
    {
        return $this->user->ability(['Admin'], ['Task:Create']);
    }

    public function store(Duty $duty)
    {
        return $this->create($duty);
    }

    public function edit(Duty $duty, Task $task)
    {
        return $this->user->ability(['Admin'], ['Task:Update']);
    }

    public function update(Duty $duty, Task $task)
    {
        return $this->edit($duty, $task);
    }

    public function duplicate(Duty $duty, Task $task)
    {
        return $this->user->ability(['Admin'], ['Task:Duplicate']);
    }

    public function revisions(Duty $duty, Task $task)
    {
        return $this->user->ability(['Admin'], ['Task:Revisions']);
    }

    public function destroy(Duty $duty, Task $task)
    {
        return $this->user->ability(['Admin'], ['Task:Delete']);
    }

    public function delete(Duty $duty, Task $task)
    {
        return $this->destroy($duty, $task);
    }
}