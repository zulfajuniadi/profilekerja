<?php

namespace App\Policies;

use App\CommitteeMember;
use App\Occupation;
use App\Libraries\Policy\BasePolicy;

class CommitteeMembersPolicy extends BasePolicy
{
    public function index(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['CommitteeMember:List']);
    }

    public function data(Occupation $occupation)
    {
        return $this->index($occupation);
    }

    public function show(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return $this->user->ability(['Admin'], ['CommitteeMember:Show']);
    }

    public function create(Occupation $occupation)
    {
        return $this->user->ability(['Admin'], ['CommitteeMember:Create']);
    }

    public function store(Occupation $occupation)
    {
        return $this->create($occupation);
    }

    public function edit(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return $this->user->ability(['Admin'], ['CommitteeMember:Update']);
    }

    public function update(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return $this->edit($occupation, $committeeMember);
    }

    public function duplicate(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return $this->user->ability(['Admin'], ['CommitteeMember:Duplicate']);
    }

    public function revisions(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return $this->user->ability(['Admin'], ['CommitteeMember:Revisions']);
    }

    public function destroy(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return $this->user->ability(['Admin'], ['CommitteeMember:Delete']);
    }

    public function delete(Occupation $occupation, CommitteeMember $committeeMember)
    {
        return $this->destroy($occupation, $committeeMember);
    }
}