<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_product_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('model_product_id')->unsigned();
            $table->foreign('model_product_id')->references('id')
                ->on('model_products')->onDelete('cascade');
            $table->bigInteger('attribute_id')->unsigned();
            $table->foreign('attribute_id')->references('id')
                ->on('attributes')->onDelete('cascade');
            $table->integer('sort')->default(1);
            $table->boolean('enable_visible')->default(1);
            $table->boolean('enable_varient')->default(0);            
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
        Schema::dropIfExists('model_product_attributes');
    }
}
