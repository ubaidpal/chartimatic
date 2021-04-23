<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->integer('file_id', FALSE,TRUE);
            $table->string('secondary_title',100);
            $table->string('banner_type',25);
            $table->integer('parent_id', FALSE,TRUE)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('object_type', 25);
            $table->string('object_value', 25);
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
        Schema::drop('banners');
    }
}
