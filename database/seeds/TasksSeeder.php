<?php

use App\Repositories\PermissionGroupsRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\TasksRepository;
use Illuminate\Database\Seeder;
use App\PermissionGroup;
use App\Permission;
use App\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->truncate();

        $tasks = [];

        foreach ($tasks as $taskData) {
            TasksRepository::create(new Task, $taskData);
        }

        $permissionGroup = PermissionGroupsRepository::create(new PermissionGroup, ['name' => 'Tasks']);

        $permissionGroup->permissions()->saveMany(array_map(function($permissionData){
            return new Permission($permissionData);
        }, [
            ['name' => 'Task:List', 'display_name' => 'List Task'],
            ['name' => 'Task:Show', 'display_name' => 'View Task Details'],
            ['name' => 'Task:Create', 'display_name' => 'Create New Task'],
            ['name' => 'Task:Update', 'display_name' => 'Update Existing Task'],
            ['name' => 'Task:Duplicate', 'display_name' => 'Duplicate Existing Task'],
            ['name' => 'Task:Revisions', 'display_name' => 'View Revisions For Task'],
            ['name' => 'Task:Delete', 'display_name' => 'Delete Existing Task'],
        ]));
    }
}
