<?php

class SellerController extends BaseController{
	public $restful = true;
	
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
		// $result = Seller::find($id)->delete();
		$result = array(
				"id" => $id,
				"status" => "Success"
			);
		return BaseController::jsonify($result);
	}

	public function postSellerByName($name){
		$seller = Seller::where('name', '=', $name)->get();
		$result = 0;
		if(!sizeof($seller)){
			$seller = new Seller;
			$seller->name = $name;
			$seller->address = "NA";
			$seller->contact = 0;
			$seller->rating = -1;
			$seller->save();
			$result = array(
				"entity" => "seller",
				"status" => 'Success',
				"requestType" => "POST",
				"seller" => $seller
				);
		}else{
			$result = array(
				"entity" => "seller",
				"status" => 'Failure',
				"requestType" => "POST",
				"reason" => 'SellerName taken',
				"seller" => $seller
				);
		}
		return BaseController::jsonify($result);
	}

	public function putSellerByID($id){
		$seller = Seller::find($id);
		$seller->name = Input::get('name', $seller->name);
		$seller->address = Input::get('address', $seller->address);
		$seller->contact = Input::get('contact', $seller->contact);
		$seller->rating = Input::get('rating', $seller->rating);

		$seller->save();

		$result = array(
				"entity" => "seller",
				"status" => "Success",
				"requestType" => "PUT",
				"seller" => $seller
				);

		return BaseController::jsonify($result);
	}

	public function getSellerList(){
		$result = Seller::all();
		return BaseController::jsonify($result);
	}

	// public function renameSeller($id, $apikey){
	// 	if(!BaseController::authenticate($apikey, 3)) 
	// 		return BaseController::jsonify(array("status" => "Failure", "reason" => "API Key has insufficient privileges"));

	// 	$seller = Seller::find($id);
	// 	$result = 1
	// 	if(!Input::has('newname')){
	// 		$result = array(
	// 			"status" => "Failure",
	// 			"reason" => "Input not found"
	// 			);
	// 	}

	// 	$seller = Seller::find($id);
	// 	if($seller->isEmpty()){
	// 		$result = array(
	// 			"status" => "Failure",
	// 			"reason" => "SellerID not found"
	// 			);
	// 	}

	// 	if($result != 1) return BaseController::jsonify($result);

	// 	$seller->name = Input::get('newname');
	// 	$seller->save();
	// 	$result = array(
	// 		"status" => "Success",
	// 		"message" => "Name renamed to ". Input::get('newname')
	// 		);

	// 	return BaseController::jsonify($result);
	// }

}


?>