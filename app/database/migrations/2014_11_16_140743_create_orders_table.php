<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		// Schema::create('orders', function($table){
		// 	$table->increments('id');
		// 	$table->integer('customerid');
		// 	$table->string('productids');
		// 	$table->string('stocks');
		// 	$table->string('sellerids');
		// 	$table->string('billingaddress');
		// 	$table->string('shippingaddress');
		// 	$table->timestamps();
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::drop('orders');
	}

}
