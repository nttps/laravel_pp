<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->unsignedInteger('inventory_quantity');
            $table->integer('old_inventory_quantity');
            $table->string('discount_price')->nullable();
            $table->string('price');
            $table->text('short_description')->nullable();
            $table->text('body_html')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_sales')->default(0);
            $table->boolean('is_show')->default(0);
            $table->timestamps();
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
