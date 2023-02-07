<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slide_id')->unsigned()->index();
            $table->char('locale', 2)->index();
            $table->string('slug');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('seo_keywords');
            $table->string('name');
            $table->string('short_description');
            $table->text('description');
            $table->unique(['slide_id', 'locale']);
            $table->foreign('slide_id')
                ->references('id')
                ->on('slides')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('slides_data');
    }
}
