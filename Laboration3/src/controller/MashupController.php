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
		$data = $this->trafficInformation->getTrafficInformation();

		if($data === false){
			return $this->mashupView->content("Trafikinformation kunde tyvärr inte hämtas för tillfället"); 
		}else{
			return $this->mashupView->content(""); 
		} 
	} 
}