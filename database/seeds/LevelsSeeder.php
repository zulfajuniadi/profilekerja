<?php

use App\Repositories\PermissionGroupsRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\LevelsRepository;
use Illuminate\Database\Seeder;
use App\PermissionGroup;
use App\Permission;
use App\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->truncate();

        $levels = [];

        foreach ($levels as $levelData) {
            LevelsRepository::create(new Level, $levelData);
        }

        $permissionGroup = PermissionGroupsRepository::create(new PermissionGroup, ['name' => 'Levels']);

        $permissionGroup->permissions()->saveMany(array_map(function($permissionData){
            return new Permission($permissionData);
        }, [
            ['name' => 'Level:List', 'display_name' => 'List Level'],
            ['name' => 'Level:Show', 'display_name' => 'View Level Details'],
            ['name' => 'Level:Create', 'display_name' => 'Create New Level'],
            ['name' => 'Level:Update', 'display_name' => 'Update Existing Level'],
            ['name' => 'Level:Duplicate', 'display_name' => 'Duplicate Existing Level'],
            ['name' => 'Level:Revisions', 'display_name' => 'View Revisions For Level'],
            ['name' => 'Level:Delete', 'display_name' => 'Delete Existing Level'],
        ]));
    }
}
