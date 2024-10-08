<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentZoneValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_zone_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('shipment_zone_id')->unsigned();
            $table->foreign('shipment_zone_id')->references('id')
            ->on('shipment_zones')->onDelete('cascade');
            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('id')
                ->on('provinces')->onDelete('cascade');
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
        Schema::dropIfExists('shipment_zone_values');
    }
}
