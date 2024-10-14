<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'status' => 1,
            'created_by' => null,
            'role_id' => 1,
            'permissions' => null,
            'profile_image' => null,
            'email_token' => null,
            'email_verified_at' => now(),
        ]);
        DB::table('roles')->insert([
            ['name' => 'Admin', 'status' => 1, 'created_at' => '2024-01-27 14:11:35', 'updated_at' => '2024-01-27 09:45:22', 'created_by' => 1, 'updated_by' => null],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('email', 'admin@admin.com')->delete();
        DB::table('roles')->whereIn('name', ['Admin1', 'Super Admin', 'Title 1', 'customer1', 'New Role'])->delete();
    }
};
