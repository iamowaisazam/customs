<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Enums\Permission as EnumsPermission;
use App\Models\DeliveryIntimation;
use App\Models\Payorder;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions = EnumsPermission::DATA;
        foreach ($permissions as $key => $permission) {
            foreach ($permission as $name) {
                Permission::create([
                    'name' => ucfirst(str_replace('-',' ',$name)),
                    'slug' => $key.'.'.$name,
                    'grouping' => ucfirst(str_replace('-',' ',$key)),
                    'status' => 1,
                ]);
            }
        }

        $perm = Permission::pluck('slug')->toArray();
        foreach (Role::all() as $key => $role) {
            $role->permissions = implode(',',$perm);
            $role->save();
        }


    }
}
