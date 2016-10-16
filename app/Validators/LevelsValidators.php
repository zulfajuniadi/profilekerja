<?php

namespace App\Validators;

class LevelsValidators extends BaseValidator
{
    public function store($data)
    {
        return [
            // 'occupation_id' => 'required',
            'level' => 'required',
            'name' => 'required',
        ];
    }

    public function update($data)
    {
        return [
            // 'occupation_id' => 'required',
            'level' => 'required',
            'name' => 'required',
        ];
    }
}
