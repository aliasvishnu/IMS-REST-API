<?php

class ProductController extends BaseController{
	public $restful = true;

	public function getProductInfoByID($id){
		$product = Product::find($id);

		$result = array("id" => $id, 
						"name" => $product->name,
						"category" => array($product->category => $product->subcategory),
						"manufacturer" => $product->manufacturer
						);

		return BaseController::jsonify($result);
	}

	public function deleteProductByID($id){
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

	public function getSellersOfProductID($id){
		$results = ProductSeller::where('productid', '=', $id)->get();

		$temp = array();
		foreach ($results as $key => $result) {
			array_push($temp, $result);
		}
		return BaseController::jsonify($temp);
		
	}
	
}



?>