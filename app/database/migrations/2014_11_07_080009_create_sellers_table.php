<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		// Schema::create('sellers', function($table){
		// 	$table->increments('id');
		// 	$table->string('name', 200);
		// 	$table->string('address', 500);
		// 	$table->string('contact', 100);
		// 	$table->date('contract_begin');
		// 	$table->date('contract_end');
		// 	$table->integer('rating');
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		// Schema::drop('sellers');
	}

}
