<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('display_name');
            $table->longText('body_html')->nullable();
            $table->bigInteger('post_category_id')->unsigned();

            $table->string('locale')->index();
            $table->unique(['post_category_id', 'locale']);
            $table->foreign('post_category_id')->references('id')
                ->on('post_categories')->onDelete('cascade');
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
        Schema::dropIfExists('post_category_translations');
    }
}
