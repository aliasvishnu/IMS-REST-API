<?php

class SellerController extends BaseController{

	public function getSellerInfoByID($id){
		$seller = Seller::find($id);

		// $productResult = Product::where('sellerid', '=', $id)->get();

		$productList = array();
		// foreach ($productResult as $key => $product) {
		// 	array_push($productList, $product->id);
		// }

		$result = array(
				"id" => $seller->id,
				"name" => $seller->name,
				"address" => $seller->address,
				"contact" => $seller->contact,
				"contract_begin" => $seller->contract_begin,
				"contract_end" => $seller->contract_end,
				"rating" => $seller->rating,
				"products" => $productList
			);

		return BaseController::jsonify($result);
	}


	public function deleteSellerByID($id){
		$result = Seller::find($id)->delete();
		$result = array(
				"id" => $id,
				"entity" -> "seller",
				"requestType" => "DELETE",
				"status" => "200"
			);
		return BaseController::jsonify($result);
	}

}


?>