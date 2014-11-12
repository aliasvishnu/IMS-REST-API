<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSellerRelationship extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		// Schema::create('product_seller', function($table){
		// 	$table->integer('productid');
		// 	$table->integer('sellerid');
		// 	$table->primary(array('productid', 'sellerid'));
		// 	$table->integer('cost');
		// 	$table->integer('stock');
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		// Schema::drop('product_seller');
	}

}
