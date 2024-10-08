<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelProductRelatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_product_relates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('model_product_id')->unsigned();
            $table->foreign('model_product_id')->references('id')
                ->on('model_products')->onDelete('cascade');
            $table->bigInteger('model_relate_id')->unsigned();
            $table->foreign('model_relate_id')->references('id')
                    ->on('model_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_product_relates');
    }
}
