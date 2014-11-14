<?php

/*
** ErrorCodes
*********************************
*********************************
** a100 - Insufficient API Key Priviliges
** a200 - Couldn't find data
** 
*/
class Errors extends BaseController{

	public function returnError($errorCode){
		$error = array();
		switch($errorCode){

			case 'a100' : 
						$error = array(
							"status" => "Failure",
							"reason" => "API Key doesn't have the required privileges"
							);
						break;
			case 'a200' : 
						$error = array(
							"status" => "Failure",
							"reason" => "Failed to fetch POST Data"
							);
						break;
			default: $error = array(
							"status" => "Failure",
							"reason" => "undefined"
						);
		}

		return BaseController::jsonify($error;)
	}
}

?>