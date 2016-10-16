<?php

namespace App\Policies;

use App\Secretariat;
use App\Occupation;
use App\Libraries\Policy\BasePolicy;

class SecretariatsPolicy extends BasePolicy
{
    public function index(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Secretariat:List']);
    }

    public function data(Occupation $occupation)
    {
        return $this->index($occupation);
    }

    public function show(Occupation $occupation, Secretariat $secretariat)
    {
        return $this->user->ability(['Admin'], ['Secretariat:Show']);
    }

    public function create(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['Secretariat:Create']);
    }

    public function store(Occupation $occupation)
    {
        return $this->create($occupation);
    }

    public function edit(Occupation $occupation, Secretariat $secretariat)
    {
        return $this->user->ability(['Admin'], ['Secretariat:Update']);
    }

    public function update(Occupation $occupation, Secretariat $secretariat)
    {
        return $this->edit($occupation, $secretariat);
    }

    public function duplicate(Occupation $occupation, Secretariat $secretariat)
    {
        return $this->user->ability(['Admin'], ['Secretariat:Duplicate']);
    }

    public function revisions(Occupation $occupation, Secretariat $secretariat)
    {
        return $this->user->ability(['Admin'], ['Secretariat:Revisions']);
    }

    public function destroy(Occupation $occupation, Secretariat $secretariat)
    {
        return $this->user->ability(['Admin'], ['Secretariat:Delete']);
    }

    public function delete(Occupation $occupation, Secretariat $secretariat)
    {
        return $this->destroy($occupation, $secretariat);
    }
}