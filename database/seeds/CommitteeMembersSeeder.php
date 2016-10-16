<?php

use App\Repositories\PermissionGroupsRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\CommitteeMembersRepository;
use Illuminate\Database\Seeder;
use App\PermissionGroup;
use App\Permission;
use App\CommitteeMember;

class CommitteeMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('committee_members')->truncate();

        $committeeMembers = [];

        foreach ($committeeMembers as $committeeMemberData) {
            CommitteeMembersRepository::create(new CommitteeMember, $committeeMemberData);
        }

        $permissionGroup = PermissionGroupsRepository::create(new PermissionGroup, ['name' => 'Committee Members']);

        $permissionGroup->permissions()->saveMany(array_map(function($permissionData){
            return new Permission($permissionData);
        }, [
            ['name' => 'CommitteeMember:List', 'display_name' => 'List Committee Member'],
            ['name' => 'CommitteeMember:Show', 'display_name' => 'View Committee Member Details'],
            ['name' => 'CommitteeMember:Create', 'display_name' => 'Create New Committee Member'],
            ['name' => 'CommitteeMember:Update', 'display_name' => 'Update Existing Committee Member'],
            ['name' => 'CommitteeMember:Duplicate', 'display_name' => 'Duplicate Existing Committee Member'],
            ['name' => 'CommitteeMember:Revisions', 'display_name' => 'View Revisions For Committee Member'],
            ['name' => 'CommitteeMember:Delete', 'display_name' => 'Delete Existing Committee Member'],
        ]));
    }
}
