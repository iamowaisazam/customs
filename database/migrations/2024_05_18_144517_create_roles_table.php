<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Primary key column with auto-increment
            $table->string('name'); // Name column of type varchar
            $table->integer('status')->nullable(); // Status column of type integer, nullable
            $table->timestamps(); // Adds created_at and updated_at columns of type timestamp
            $table->unsignedBigInteger('created_by')->nullable(); // Nullable created_by column of type big integer
            $table->unsignedBigInteger('updated_by')->nullable(); // Nullable updated_by column of type big integer

            // Foreign key constraints
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
