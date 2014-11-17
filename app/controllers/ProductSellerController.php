<?php

class ProductSellerController extends BaseController{

	public function addUpdateProduct($apikey){
		if(!BaseController::checkPrerequisites(array('productid', 'sellerid', 'stock', 'cost')))
			return BaseController::returnError('a200');

		$productid = Input::get('productid');
		$sellerid = Input::get('sellerid');
		$cost = Input::get('cost');
		$stock = Input::get('stock');

		$operation = array();
		$product = ProductSeller::whereRaw('productid = ? and sellerid = ?', array($productid, $sellerid))->get();
		if($product->isEmpty()){
			$product = new ProductSeller;
			$product->productid = $productid;
			$product->sellerid = $sellerid;
			$product->cost = $cost;
			$product->stock = $stock;
			$product->save();
			$operation = 'New';
		}else{
			$product = $product->first();
			$product->cost = $cost;
			$product->stock = $stock;
			/* Laravel Bug
			** Cannot save models with composite primary keys
			** Used DB Class Static methods as workaround
			*/

			// $product->save();
			DB::update("update product_seller set cost=$cost, stock = $stock where productid=$productid and sellerid=$sellerid");
		}

		return BaseController::jsonify(array(
						"status" => "success",
						"product" => $product
						));
	}

	public function removeProductFromSellerOffering($apikey){
		if(!BaseController::checkPrerequisites(array('productid', 'sellerid')))
			return BaseController::returnError('a200');


		$productid = Input::get('productid');
		$sellerid = Input::get('sellerid');
		$result = array();
		$product = ProductSeller::whereRaw("productid = ? and sellerid = ?", array($productid, $sellerid))->get();
		if($product->isEmpty()){
			$result = array(
				"status" => "Failure",
				"reason" => "Product is not sold by Seller"
				);
		}else{
			/*
			** Laravel Bug: Cannot delete from model with composite primary keys.
			** Used DB class static methods as workaround.
			*/
			// $product = $product->first();
			// $product->delete();

			/** Need to sanitize input**/

			// DB::delete("delete from product_seller where productid = $productid and sellerid = $sellerid");
			$result = array("status" => "Success");
		}
		return BaseController::jsonify($result);
	}

	public function reduceProductCountMain($productid, $sellerid, $count){
		$result = ProductSeller::whereRaw("productid = ? and sellerid = ?", array($productid, $sellerid))->get()->first();
		if($result->stock >= $count){
			// $result->stock -= $count;
			DB::update("update product_seller set stock=$result->stock where productid=$productid and sellerid=$sellerid");

			return array(
						"status" => "Success",
						"productid" => $productid,
						"sellerid" => $sellerid,
						"remainingStock" => $result->stock
				);
		}else{
			return array(
						"status" => "Failure",
						"reason" => "Not enough stock",
						"productid" => $productid,
						"sellerid" => $sellerid,
						"remainingStock" => $result->stock
				);
		}
		
	}

	public function reduceProductCount($apikey, $productid, $sellerid){
		$count = Input::get('count');
		return BaseController::jsonify(reduceProductCountMain($productid, $sellerid, $count));
	}

	public function getSellersOfProductID($id){
		$results = ProductSeller::where('productid', '=', $id)->get();

		$temp = array();
		foreach ($results as $key => $result) {
			array_push($temp, $result);
		}
		return BaseController::jsonify($temp);
	}

	public function getProductsOfSellerID($id){
		$result = ProductSeller::where('sellerid', '=', $id)->get();
		return BaseController::jsonify($result);
	}

}


?>