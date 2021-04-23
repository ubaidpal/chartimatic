<?php

use Illuminate\Database\Migrations\Migration;

class CreateTaxCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tax_categories', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('value');
            $table->string('tax_code');
            $table->enum('is_percent', [0, 1])->default(0);
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
        Schema::drop('tax_categories');
	}

}
