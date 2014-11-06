<?php

class ProductController extends BaseController{
	
	public function getProductInfoByID($id){
		$product = Product::find($id);

		$result = array("id" => $id, 
						"name" => $product->name,
						"cost" => $product->cost,
						"category" => array($product->category => $product->subcategory),
						"stockRemaining" => $product->stock,
						"seller" => array(
									"id" => $product->sellerid
							),
						"warehouse" => array(
										"id" => $product->warehouseid
							)
						);
		return $result;
	}
}



?>