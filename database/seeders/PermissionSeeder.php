<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::create(['name'=>'Create-Employee','guard_name'=>'employee']);
        Permission::create(['name'=>'Read-Employees','guard_name'=>'employee']);
        Permission::create(['name'=>'Update-Employee','guard_name'=>'employee']);
        Permission::create(['name'=>'Delete-Employee','guard_name'=>'employee']);
        
        Permission::create(['name'=>'Create-Attendance','guard_name'=>'employee']);
        Permission::create(['name'=>'Read-Attendances','guard_name'=>'employee']);
        Permission::create(['name'=>'Update-Attendance','guard_name'=>'employee']);
        Permission::create(['name'=>'Delete-Attendance','guard_name'=>'employee']);

        Permission::create(['name'=>'Create-Project','guard_name'=>'employee']);
        Permission::create(['name'=>'Read-Projects','guard_name'=>'employee']);
        Permission::create(['name'=>'Update-Project','guard_name'=>'employee']);
        Permission::create(['name'=>'Delete-Project','guard_name'=>'employee']);

        Permission::create(['name'=>'Create-Task','guard_name'=>'employee']);
        Permission::create(['name'=>'Read-Tasks','guard_name'=>'employee']);
        Permission::create(['name'=>'Update-Task','guard_name'=>'employee']);
        Permission::create(['name'=>'Delete-Task','guard_name'=>'employee']);


        Permission::create(['name'=>'Create-Role','guard_name'=>'employee']);
        Permission::create(['name'=>'Read-Roles','guard_name'=>'employee']);
        Permission::create(['name'=>'Update-Role','guard_name'=>'employee']);
        Permission::create(['name'=>'Delete-Role','guard_name'=>'employee']);

        Permission::create(['name'=>'Read-Permission','guard_name'=>'employee']);
    }
}
