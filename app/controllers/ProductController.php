<?php

class ProductController extends BaseController{

	public function getProductInfoByID($id){
		$product = Product::find($id);

		$result = array("id" => $id, 
						"name" => $product->name,
						"cost" => $product->cost,
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
				"status" => 200
			);
		
		return BaseController::jsonify($result);
	}
}



?>