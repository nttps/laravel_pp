<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('shipment_zone_id')->unsigned();
            $table->foreign('shipment_zone_id')->references('id')
            ->on('shipment_zones')->onDelete('cascade');
            $table->string('name');
            $table->longText('details');
            $table->string('method');
            $table->longText('rules');
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
        Schema::dropIfExists('shipment_rules');
    }
}
