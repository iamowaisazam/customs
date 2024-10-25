<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        $permissions = [
            'User Managment',
            'Customers',
            'Vendors',
            'Job / Consignment',
            'Delivery Challan',
            'Delivery Intimation',
            'Settings',
            // 'Payment Request',
            // 'Delivery Challan',
            // 'Jobs Tracking And status',
            // 'Customer Statements',
            // 'Reports',
            // 'Job History',
            // 'Finance'
        ];

        foreach ($permissions as $value) {
            Permission::create([
                'name' => $value,
                'slug' => strtolower(str_replace(' ','',$value)),
                'status' => 1,
            ]);
        }

        $perm = Permission::pluck('slug')->toArray();
        foreach (Role::all() as $key => $role) {
            $role->permissions = implode(',',$perm);
            $role->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }

};
