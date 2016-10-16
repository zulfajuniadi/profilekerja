<?php

use App\Repositories\PermissionGroupsRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\OccupationsRepository;
use Illuminate\Database\Seeder;
use App\PermissionGroup;
use App\Permission;
use App\Occupation;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occupations')->truncate();

        $occupations = [];

        foreach ($occupations as $occupationData) {
            OccupationsRepository::create(new Occupation, $occupationData);
        }

        $permissionGroup = PermissionGroupsRepository::create(new PermissionGroup, ['name' => 'Occupations']);

        $permissionGroup->permissions()->saveMany(array_map(function($permissionData){
            return new Permission($permissionData);
        }, [
            ['name' => 'Occupation:List', 'display_name' => 'List Occupation'],
            ['name' => 'Occupation:Show', 'display_name' => 'View Occupation Details'],
            ['name' => 'Occupation:Create', 'display_name' => 'Create New Occupation'],
            ['name' => 'Occupation:Update', 'display_name' => 'Update Existing Occupation'],
            ['name' => 'Occupation:Duplicate', 'display_name' => 'Duplicate Existing Occupation'],
            ['name' => 'Occupation:Revisions', 'display_name' => 'View Revisions For Occupation'],
            ['name' => 'Occupation:Delete', 'display_name' => 'Delete Existing Occupation'],
        ]));
    }
}
