<?php

class ProductController extends BaseController{
	public $restful = true;

	public function getProductInfoByID($id, $apikey){
		$product = Product::find($id);

		$result = array(
						"status" => "Success",
						"id" => $id, 
						"name" => $product->name,
						"category" => array($product->category => $product->subcategory),
						"manufacturer" => $product->manufacturer
						);

		return BaseController::jsonify($result);
	}

	public function deleteProductByID($id){
		// $product = Product::find($id)->delete();
		// ProductSeller::where('productid', '=', $id)->get()->delete();
		
		return BaseController::jsonify($id. " deleted from DB");
	}

	public function postProductByName($name){
		$product = new Product;
		
		$product->name = $name;
		$product->category = 'category';
		$product->subcategory = 'subcategory';
		$product->manufacturer = 'manufacturer';

		$product->save();
		$result = array(
			"status" => "Success",
			"product" => $product
			);
		return BaseController::jsonify($result);
	}

	public function putProductByID($id){
		$product = Product::find($id);
		$product->name = Input::get('name', $product->name);
		$product->manufacturer = Input::get('manufacturer', $product->manufacturer);
		$product->category = Input::get('category', $product->category);
		$product->subcategory = Input::get('subcategory', $product->subcategory);		
		$product->save();
		$result = array(
			"status" => "Success",
			"product" => $product
			);

		return BaseController::jsonify($result);
	}

	public function getProductList(){
		$result = Product::all();
		return BaseController::jsonify($result);	
	}

	public function renameProduct($originalname, $apikey){
		// 	$result = 1;
		// 	if(!Input::has('newname')){
		// 		$result = array(
		// 			"status" => "Failure",
		// 			"reason" => "No new name provided"
		// 			);
		// 	}
		// 	if(!result) return BaseController::jsonify($result);
			
		// 	$product = Product::where('name', '=', $originalname)->get();		
		// 	if($product->isEmpty()){
		// 		$result = array(
		// 					"status" => "Failure",
		// 					"requestType" => "POST",
		// 					"reason" => "Product not found"
		// 					);
		// 	}else{
		// 		$product->name = $newname;
		// 		$product->save();
		// 		$result = array(
		// 				"status" => "Success",
		// 				"requestType" => "POST",
		// 				"message" => $originalname." renamed to ".$newname
		// 				);
		// 	}
		// 	return BaseController::jsonify($result);
	 }

}



?>