<?php

class UserController extends BaseController{

	public function postRegister(){
		$user = new User;
		$user->email = Input::get('email');
		$user->clearance = Input::get('clearance');
		$salt = md5(time());
		$user->apikey = sha1($salt . $user->email . time());

		$user->save();
		return BaseController::jsonify(array(
							"clearance" => $user->clearance,
							"status" => "Success",
							"api_key" => $user->apikey
						));
	}

}
?>
		