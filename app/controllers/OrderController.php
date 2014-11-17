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

	public function getOrdersByCustomerID($customerid, $apikey){
		$orders = Order::where('customerid', '=', $customerid)->get();
		return BaseController::jsonify(array(
						"status" => "Success",
						"orders" => $orders
			));	
	}

	public function postOrders(){
		if(!BaseController::checkPrerequisites(array(
				'customerid', 'sellerids', 'productids', 
				'stocks', 'billingaddress', 'shippingaddress'
			))) return BaseController::returnError('a200');
		
		$order = new Order;
		$order->customerid = Input::get('customerid');
		$order->sellerids = Input::get('sellerids');
		$order->productids = Input::get('productids');
		$order->stocks = Input::get('stocks');
		$order->billingaddress = Input::get('billingaddress');
		$order->shippingaddress = Input::get('shippingaddress');
		$order->save();

		$productList = explode('-', $order->productids);
		$sellerList = explode('-', $order->sellerids);
		$stockList = explode('-', $order->stocks);

		$result = array();

		$length = sizeof($productList);
		$psControllerObject = new ProductSellerController;
		for($i = 0; $i < $length; $i++){				
			array_push($result,
					   $psControllerObject->reduceProductCountMain(
									$productList[$i],
									$sellerList[$i],
									$stockList[$i]));
		}
		return BaseController::jsonify($result);
	}
}

?>