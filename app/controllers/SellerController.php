<?php

class SellerController extends BaseController{

	public function getSellerInfoByID($id){
		$seller = Seller::find($id);

		$result = array(
				"id" => $seller->id,
				"name" => $seller->name,
				"address" => $seller->address,
				"contact" => $seller->contact,
				"contract_begin" => $seller->contract_begin,
				"contract_end" => $seller->contract_end,
				"rating" => $seller->rating,
			);

		return BaseController::jsonify($result);
	}
}


?>