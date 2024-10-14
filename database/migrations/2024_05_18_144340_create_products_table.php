<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key column with auto-increment
            $table->text('title'); // Title column of type text
            $table->text('slug'); // Slug column of type text
            $table->double('price')->nullable(); // Nullable price column of type double
            $table->double('selling_price')->nullable(); // Nullable selling price column of type double
            $table->text('sku')->nullable(); // Nullable sku column of type text
            $table->unsignedBigInteger('category_id')->nullable(); // Nullable category ID column of type big integer
            $table->unsignedBigInteger('subcategory_id')->nullable(); // Nullable subcategory ID column of type big integer
            $table->unsignedBigInteger('subchildcategory_id')->nullable(); // Nullable subchildcategory ID column of type big integer
            $table->unsignedBigInteger('brand_id')->nullable(); // Nullable brand ID column of type big integer
            $table->text('tags')->nullable(); // Nullable tags column of type text
            $table->text('image')->nullable(); // Nullable image column of type text
            $table->text('images')->nullable(); // Nullable images column of type text
            $table->string('type', 255)->nullable(); // Nullable type column of type string
            $table->text('hover_image')->nullable(); // Nullable hover_image column of type text
            $table->tinyInteger('is_featured')->default(0); // Default 0 for is_featured column of type tiny integer
            $table->tinyInteger('is_popular')->default(0); // Default 0 for is_popular column of type tiny integer
            $table->text('details')->nullable(); // Nullable details column of type text
            $table->text('description')->nullable(); // Nullable description column of type text
            $table->text('meta_title')->nullable(); // Nullable meta_title column of type text
            $table->text('meta_description')->nullable(); // Nullable meta_description column of type text
            $table->text('meta_keywords')->nullable(); // Nullable meta_keywords column of type text
            $table->tinyInteger('is_enable')->default(1); // Default 1 for is_enable column of type tiny integer
            $table->timestamps(); // Adds created_at and updated_at columns of type timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
    