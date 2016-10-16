<?php

namespace App\Validators;

class DutiesValidators extends BaseValidator
{
    public function store($data)
    {
        return [
            // 'occupation_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ];
    }

    public function update($data)
    {
        return [
            // 'occupation_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ];
    }
}
