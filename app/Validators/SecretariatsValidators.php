<?php

namespace App\Validators;

class SecretariatsValidators extends BaseValidator
{
    public function store($data)
    {
        return [
            'occupation_id' => 'required',
            'role' => 'required',
            'name' => 'required',
        ];
    }

    public function update($data)
    {
        return [
            'occupation_id' => 'required',
            'role' => 'required',
            'name' => 'required',
        ];
    }
}