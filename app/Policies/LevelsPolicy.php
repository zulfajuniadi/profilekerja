<?php

namespace App\Policies;

use App\Level;
use App\Occupation;
use App\Libraries\Policy\BasePolicy;

class LevelsPolicy extends BasePolicy
{
    public function index(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Level:List']);
    }

    public function data(Occupation $occupation)
    {
        return $this->index($occupation);
    }

    public function show(Occupation $occupation, Level $level)
    {
        return $this->user->ability(['Admin'], ['Level:Show']);
    }

    public function create(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Level:Create']);
    }

    public function store(Occupation $occupation)
    {
        return $this->create($occupation);
    }

    public function edit(Occupation $occupation, Level $level)
    {
        return $this->user->ability(['Admin'], ['Level:Update']);
    }

    public function update(Occupation $occupation, Level $level)
    {
        return $this->edit($occupation, $level);
    }

    public function duplicate(Occupation $occupation, Level $level)
    {
        return $this->user->ability(['Admin'], ['Level:Duplicate']);
    }

    public function revisions(Occupation $occupation, Level $level)
    {
        return $this->user->ability(['Admin'], ['Level:Revisions']);
    }

    public function destroy(Occupation $occupation, Level $level)
    {
        return $this->user->ability(['Admin'], ['Level:Delete']);
    }

    public function delete(Occupation $occupation, Level $level)
    {
        return $this->destroy($occupation, $level);
    }
}