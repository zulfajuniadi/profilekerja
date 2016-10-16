<?php

namespace App\Policies;

use App\Occupation;
use App\Libraries\Policy\BasePolicy;

class OccupationsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->ability(['Admin'], ['Occupation:List']);
    }

    public function data()
    {
        return $this->index();
    }

    public function show(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Occupation:Show']);
    }

    public function create()
    {
        return $this->user->ability(['Admin'], ['Occupation:Create']);
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Occupation:Update']);
    }

    public function update(Occupation $occupation)
    {
        return $this->edit($occupation);
    }

    public function duplicate(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Occupation:Duplicate']);
    }

    public function revisions(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Occupation:Revisions']);
    }

    public function destroy(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Occupation:Delete']);
    }

    public function delete(Occupation $occupation)
    {
        return $this->destroy($occupation);
    }
}