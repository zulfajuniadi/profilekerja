<?php

use App\Repositories\PermissionGroupsRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\DutiesRepository;
use Illuminate\Database\Seeder;
use App\PermissionGroup;
use App\Permission;
use App\Duty;

class DutySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duties')->truncate();

        $duties = [];

        foreach ($duties as $dutyData) {
            DutiesRepository::create(new Duty, $dutyData);
        }

        $permissionGroup = PermissionGroupsRepository::create(new PermissionGroup, ['name' => 'Duties']);

        $permissionGroup->permissions()->saveMany(array_map(function($permissionData){
            return new Permission($permissionData);
        }, [
            ['name' => 'Duty:List', 'display_name' => 'List Duty'],
            ['name' => 'Duty:Show', 'display_name' => 'View Duty Details'],
            ['name' => 'Duty:Create', 'display_name' => 'Create New Duty'],
            ['name' => 'Duty:Update', 'display_name' => 'Update Existing Duty'],
            ['name' => 'Duty:Duplicate', 'display_name' => 'Duplicate Existing Duty'],
            ['name' => 'Duty:Revisions', 'display_name' => 'View Revisions For Duty'],
            ['name' => 'Duty:Delete', 'display_name' => 'Delete Existing Duty'],
        ]));
    }
}
