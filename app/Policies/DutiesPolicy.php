<?php

namespace App\Policies;

use App\Duty;
use App\Occupation;
use App\Libraries\Policy\BasePolicy;

class DutiesPolicy extends BasePolicy
{
    public function index(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Duty:List']);
    }

    public function data(Occupation $occupation)
    {
        return $this->index($occupation);
    }

    public function show(Occupation $occupation, Duty $duty)
    {
        return $this->user->ability(['Admin'], ['Duty:Show']);
    }

    public function create(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Duty:Create']);
    }

    public function store(Occupation $occupation)
    {
        return $this->create($occupation);
    }

    public function edit(Occupation $occupation, Duty $duty)
    {
        return $this->user->ability(['Admin'], ['Duty:Update']);
    }

    public function update(Occupation $occupation, Duty $duty)
    {
        return $this->edit($occupation, $duty);
    }

    public function duplicate(Occupation $occupation, Duty $duty)
    {
        return $this->user->ability(['Admin'], ['Duty:Duplicate']);
    }

    public function revisions(Occupation $occupation, Duty $duty)
    {
        return $this->user->ability(['Admin'], ['Duty:Revisions']);
    }

    public function destroy(Occupation $occupation, Duty $duty)
    {
        return $this->user->ability(['Admin'], ['Duty:Delete']);
    }

    public function delete(Occupation $occupation, Duty $duty)
    {
        return $this->destroy($occupation, $duty);
    }
}