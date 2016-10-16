<?php

namespace App\Validators;

class TasksValidators extends BaseValidator
{
    public function store($data)
    {
        return [
            'level_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ];
    }

    public function update($data)
    {
        return [
            'level_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ];
    }
}
