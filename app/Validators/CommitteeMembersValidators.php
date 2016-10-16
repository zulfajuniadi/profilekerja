<?php

namespace App\Validators;

class CommitteeMembersValidators extends BaseValidator
{
    public function store($data)
    {
        return [
            'occupation_id' => 'required',
            'name' => 'required',
            'company' => 'required',
        ];
    }

    public function update($data)
    {
        return [
            'occupation_id' => 'required',
            'name' => 'required',
            'company' => 'required',
        ];
    }
}