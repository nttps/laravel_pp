<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('parent_id')->unsigned()->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('post_categories')->onUpdate('cascade')->onDelete('set null');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->longText('seo_meta')->nullable();
            $table->longText('banner_header')->nullable();
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('post_categories');
    }
}
