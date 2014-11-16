<?php

class OrderController extends BaseController{

	public function getOrderInfoByID($id, $apikey){
		$order = Order::find($id);
		return BaseController::jsonify(array(
						"status" => "Success",
						"order" => $order
					)
			);
	}

	public function getOrders($apikey){
		$orders = Order::all();
		return BaseController::jsonify(array(
						"status" => "Success",
						"orders" => $orders
			));
	}
	
	/* Method not supported due to framework limitations */
	public function getOrdersByProductID($apikey, $productid){
		$orders = Order::where('productid', "=", $productid);
		return BaseController::jsonify(array(
						"status" => "Success",
						"orders" => $orders
			));	
	}

	/* Method not supported due to framework limitations */
	public function getOrdersBySellerID($apikey, $sellerid){
		$orders = Order::where('sellerid', "=", $sellerid);
		return BaseController::jsonify(array(
						"status" => "Success",
						"orders" => $orders
			));	
	}

	public function getOrdersByCustomerID($apikey, $customerid){
		$orders = Order::where('customerid', '=', $customerid);
		// return BaseController::jsonify(array(
		// 				"status" => "Success",
		// 				"orders" => $orders
		// 	));	
		return $orders;
	}

	public function postOrders($apikey){
		// if()
	}



}

?>