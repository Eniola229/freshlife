<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_code')->unique();
            $table->string('category_id');
   
            $table->decimal('product_price', 8, 2);
            $table->decimal('product_discount', 8, 2)->nullable();
            $table->decimal('product_weight', 8, 2);
            $table->string('main_image');
            $table->json('additional_images')->nullable(); // JSON type for storing multiple images
            $table->text('description');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
