<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	protected function setupLayout()
	{

		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


	public function jsonify($json){
		return Response::json($json, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);
	}

	public function authenticate($apikey, $requiredClearanceLevel){
		$actualClearanceLevel = User::where('apikey', '=', $apikey)->get()->first();
		$actualClearanceLevel = $actualClearanceLevel->clearance;
		if($requiredClearanceLevel <= $actualClearanceLevel) return 1;
		else return 0;
	}

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

		return BaseController::jsonify($error);
	}

	public function checkPrerequisites($requirements){
		foreach($requirements as $requirement){
			if(!Input::has($requirement)) return 0;
		}
		return 1;
	}


}
