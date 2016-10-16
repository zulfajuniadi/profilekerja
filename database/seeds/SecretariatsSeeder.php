<?php

use App\Repositories\PermissionGroupsRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\SecretariatsRepository;
use Illuminate\Database\Seeder;
use App\PermissionGroup;
use App\Permission;
use App\Secretariat;

class SecretariatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secretariats')->truncate();

        $secretariats = [];

        foreach ($secretariats as $secretariatData) {
            SecretariatsRepository::create(new Secretariat, $secretariatData);
        }

        $permissionGroup = PermissionGroupsRepository::create(new PermissionGroup, ['name' => 'Secretariats']);

        $permissionGroup->permissions()->saveMany(array_map(function($permissionData){
            return new Permission($permissionData);
        }, [
            ['name' => 'Secretariat:List', 'display_name' => 'List Secretariat'],
            ['name' => 'Secretariat:Show', 'display_name' => 'View Secretariat Details'],
            ['name' => 'Secretariat:Create', 'display_name' => 'Create New Secretariat'],
            ['name' => 'Secretariat:Update', 'display_name' => 'Update Existing Secretariat'],
            ['name' => 'Secretariat:Duplicate', 'display_name' => 'Duplicate Existing Secretariat'],
            ['name' => 'Secretariat:Revisions', 'display_name' => 'View Revisions For Secretariat'],
            ['name' => 'Secretariat:Delete', 'display_name' => 'Delete Existing Secretariat'],
        ]));
    }
}
