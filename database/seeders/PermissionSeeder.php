<?php

namespace Database\Seeders;

use App\Enums\Permission as EnumsPermission;
use App\Models\Customer;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class PermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {

        //Admin..

        User::select('*')->delete();
        Role::select('*')->delete();
        Permission::select('*')->delete();

        Role::create(['id' => 1,'name' => 'Admin']);
        Role::create(['id' => 2,'name' => 'User']);
        Role::create(['id' => 3,'name' => 'Customer']);
        Role::create(['id' => 4,'name' => 'Vendor']);


        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@customs.com',
            'password' => Hash::make('admin12345'),
            'role_id' => 1,
        ]);

        $user = User::create([
            'name' => 'user12345',
            'email' => 'user@customs.com',
            'password' => Hash::make('user12345'),
            'role_id' => 2,
        ]);
        
        

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