<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout(){
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

}
