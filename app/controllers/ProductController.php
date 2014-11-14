<?php

class ProductController extends BaseController{
	public $restful = true;

	public function getProductInfoByID($id, $apikey){
		if(!BaseController::authenticate($apikey, 2)){
			return BaseController::jsonify("Failure");
		}

		$product = Product::find($id);

		$result = array("id" => $id, 
						"name" => $product->name,
						"category" => array($product->category => $product->subcategory),
						"manufacturer" => $product->manufacturer
						);

		return BaseController::jsonify($result);
	}

	public function deleteProductByID($id){
		if(!BaseController::authenticate($apikey, 2))
			return BaseController::jsonify("Failure");
		
		return Input::get('apikey');
		// $product = Product::find($id)->delete();

		$result = array(
				"id" => $id,
				"entity" => "product",
				"requestType" => "DELETE",
				"status" => "Success"
			);
		
		return BaseController::jsonify($result);
	}

	public function postProductByName($name){
		$product = new Product;
		
		$product->name = $name;
		$product->category = $category;
		$product->subcategory = $subcategory;
		$product->manufacturer = $manufacturer;


		$product->save();
		$result = array(
			"entity" => "product",
			"status" => "Success",
			"requestType" => "POST",
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
			"entity" => "product",
			"status" => "Success",
			"requestType" => "PUT",
			"product" => $product
			);

		return BaseController::jsonify($result);
	}

	public function getProductList(){
		$result = Product::all();
		return BaseController::jsonify($result);	
	}

	public function renameProduct($originalname, $apikey){
		$result = 1;
		if(!Input::has('newname')){
			$result = array(
				"status" => "Failure",
				"reason" => "No new name provided"
				);
		}
		if(!BaseController:authenticate($apikey, 3)){
			$result = array(
				"status" => "Failure",
				"reason" => "API Key does not have clearance"
				);
		}
		if(!result) return BaseController::jsonify($result);
		
		$product = Product::where('name', '=', $originalname)->get();		
		if($product->isEmpty()){
			$result = array(
						"status" => "Failure",
						"requestType" => "POST",
						"reason" => "Product not found"
						);
		}else{
			$product->name = $newname;
			$product->save();
			$result = array(
					"status" => "Success",
					"requestType" => "POST",
					"message" => $originalname." renamed to ".$newname
					);
		}
		return BaseController::jsonify($result);
	}

	


}



?>