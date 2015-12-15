<?php

class TrafficInformation{

	private $url;  

	public function __construct(){

		$this->url = "http://api.sr.se/api/v2/traffic/messages?format=json&pagination=false";  
	}

	public function getTrafficInformation(){

		$timefile = fopen("src/model/time.txt", "r+") or die("Unable to open file!");
		$time =  fread($timefile,filesize("src/model/time.txt")); 
		fclose($timefile);

		if(($time + 300) < time()){
			$timefile = fopen("src/model/time.txt", "w+") or die("Unable to open file!");
			fwrite($timefile, time());
			fclose($timefile); 

			$data = $this->getData($this->url); 	
		//	var_dump(json_decode($data, true));  die(); 

			$jsonfile = fopen("src/model/sr.json", "w+") or die("Unable to open file!");
			fwrite($jsonfile, $data);
			fclose($jsonfile);
		}
	}

 // curl snabbare än get_file_contents
	public function getData($url){
		header('Content-Type:text/html; charset=utf-8');

		$ch = curl_init(); 

		curl_setopt($ch, CURLOPT_URL , $url); 
	
		// talar om att det vi hämtar hem inte ska skrivas ut direkt.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
		// identifierar mig. 
		curl_setopt($ch, CURLOPT_USERAGENT,"as223my"); 
	
		$data = curl_exec($ch);
		curl_close($ch); 
		
		return $data;
		}
}