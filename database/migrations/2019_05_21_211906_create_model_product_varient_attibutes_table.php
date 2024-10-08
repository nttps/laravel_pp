<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelProductVarientAttibutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_product_varient_attibutes', function (Blueprint $table) {
            $table->bigInteger('model_product_id')->unsigned();
            $table->foreign('model_product_id')->references('id')
                ->on('model_products')->onDelete('cascade');
            $table->bigInteger('model_varient_id')->unsigned();
            $table->foreign('model_varient_id')->references('id')
                    ->on('model_products')->onDelete('cascade');
            $table->bigInteger('product_attribute_id')->unsigned();
            $table->foreign('product_attribute_id')->references('id')
                        ->on('model_product_attributes')->onDelete('cascade');
            $table->bigInteger('product_attribute_value_id')->unsigned();
            $table->foreign('product_attribute_value_id', 'product_attribute_value_foreign')->references('id')
                ->on('model_product_attribute_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_product_varient_attibutes');
    }
}
