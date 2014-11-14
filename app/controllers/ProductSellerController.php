<?php

class ProductSellerController extends BaseController{

	public function addUpdateProduct($apikey){
		if(!BaseController::authenticate($apikey, 2)) 
			return Errors::returnError('a100');

		$required = array('productid', 'sellerid', 'stock', 'cost');
		foreach($required as $requiredAttribute){
			if(!Input::has($requiredAttribute))
				return Errors::returnError('a200');
		}

		$operation = null;
		$product = ProductSeller::whereRaw('productid = ? and sellerid = ?', array($productid, $sellerid))->get();
		if($product->isEmpty()){
			$product = new ProductSeller;
			$product->productid = Input::get('productid');
			$product->sellerid = Input::get('sellerid');
			$product->cost = Input::get('cost');
			$product->stock = Input::get('stock');
			$product->save();
			$operation = 'New';
		}else{
			$product->cost = Input::get('cost', $product->cost);
			$product->stock = Input::get('stock', $product->stock);
		}
	}

	public function removeProductFromSellerOffering($productid, $sellerid, $apikey){
		$result = array();
		if(!BaseController::authenticate($apikey, 2)){
			$result = array(
				"status" => "Failure",
				"reason" => "Key is unauthorized for this action"
				);
		}	
		$product = ProductSeller::whereRaw("productid = ? and sellerid = ?" , array($productid, $sellerid))->get();
		if($product->isEmpty()){
			$result = array(
				"status" => "Failure",
				"reason" => "Product is not sold by Seller"
				);
		}else{
			$product = $product->first()->delete();
		}
	}

	public function reduceProductCount($productid, $sellerid, $count){
		// $result = ProductSeller::whereRaw('productid = ? and sellerid = ?', array($productid, $sellerid));
		// if($result->stock >= $count){
		// 	$result->stock -= $count;
		// 	$result->save();

		// 	$return BaseController::jsonify(array(
		// 				"status" => "Success",
		// 				"productid" => $productid,
		// 				"sellerid" => $sellerid,
		// 				"remainingStock" => $result->stock
		// 		));
		// }else{
		// 	$return BaseController::jsonify(array(
		// 				"status" => "Failure",
		// 				"reason" => "Not enough stock",
		// 				"productid" => $productid,
		// 				"sellerid" => $sellerid,
		// 				"remainingStock" => $result->stock
		// 		));
		// }
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