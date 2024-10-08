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
            $table->bigIncrements('id')->unsigned();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('sku', 50)->unique();
            $table->float('regular_price');
            $table->float('sale_price');
            $table->integer('stock');
            $table->integer('order')->default(1);
            $table->boolean('published')->default(1);
            $table->longText('seo_meta')->nullable();
            $table->longText('options')->nullable();
            $table->string('type', 50);
            $table->longText('banner_header')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
