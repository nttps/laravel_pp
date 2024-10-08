<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_products', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('sku', 50)->unique()->nullable();
            $table->float('regular_price')->nullable();
            $table->float('sale_price')->nullable();
            $table->float('shipping_price')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('order')->default(1);
            $table->boolean('published')->default(1);
            $table->longText('seo_meta')->nullable();
            $table->longText('options')->nullable();
            $table->string('type', 50);
            $table->longText('banner_header')->nullable();
            $table->longText('images')->nullable();
            $table->longText('relate_items')->nullable();
            $table->bigInteger('parent_id')->unsigned()->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('model_products')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('model_products');
    }
}
