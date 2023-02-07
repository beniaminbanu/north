<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('handler_controller')->nullable();
            $table->string('handler_view')->nullable();
            $table->string('handler_action')->nullable();
            $table->string('class')->nullable();
            $table->integer('order');
            $table->enum('status', ['active', 'inactive']);
            $table->integer('parent_id')->unsigned()->index();
            $table->text('image')->nullable();
            $table->boolean('is_searchable');
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
        Schema::dropIfExists('pages');
    }
}
