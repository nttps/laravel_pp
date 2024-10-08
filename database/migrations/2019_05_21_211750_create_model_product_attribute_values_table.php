<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_product_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('model_product_attribute_id')->unsigned();
            $table->foreign('model_product_attribute_id' , 'product_attribute_id_foreign')->references('id')
                ->on('model_product_attributes')->onDelete('cascade');
             $table->bigInteger('attribute_value_id')->unsigned();
            $table->foreign('attribute_value_id', 'attribute_value_id_foreign')->references('id')
                    ->on('attribute_values')->onDelete('cascade');
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
        Schema::dropIfExists('model_product_attribute_values');
    }
}
