<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('products', function($table){
			$table->increments('id');
			$table->string('name', 100);
			$table->integer('cost');
			$table->integer('stock');
			$table->integer('sellerid');
			$table->string('category');
			$table->string('subcategory');
			$table->integer('warehouseid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::drop('products');
	}

}
