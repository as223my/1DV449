<?php

require_once("./src/model/TrafficInformation.php");
require_once("./src/view/MashupView.php");
	
class MashupController{

	private $trafficInformation; 
	private $mashupView; 

	public function __construct(){

		$this->trafficInformation = new \TrafficInformation();
		$this->mashupView = new \MashupView();
	}

	public function srTrafficInformation(){

		$this->trafficInformation->getTrafficInformation();
		return $this->mashupView->content(); 
	} 

}