<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductInPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_in_pages', function (Blueprint $table) {
            $table->bigInteger('model_product_id')->unsigned();
            $table->foreign('model_product_id')->references('id')
                ->on('model_products')->onDelete('cascade');
            $table->bigInteger('page_id')->unsigned();
            $table->foreign('page_id')->references('id')
                    ->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_in_pages');
    }
}
