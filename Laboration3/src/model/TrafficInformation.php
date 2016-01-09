<?php

class TrafficInformation{

	private $url; 
	private $filepathTime;
	private $filepathJson; 

	public function __construct(){
		$this->url = "http://api.sr.se/api/v2/traffic/messages?format=json&pagination=false";  
		$this->filepathTime = "src/model/time.txt";
		$this->filepathJson = "src/model/sr.json";
	}

	/*  Hämtar ny data från sr om mer en 5 minuter gått sedan sista cachningen, och sparar ner detta i en fil. */
	public function getTrafficInformation(){
		$data = ""; 

		$timefile = fopen($this->filepathTime, "r+") or die("Unable to open file!");
		$time =  fread($timefile,filesize($this->filepathTime)); 
		fclose($timefile);

		if(($time + 300) < time()){
			$timefile = fopen($this->filepathTime, "w+") or die("Unable to open file!");
			fwrite($timefile, time());
			fclose($timefile); 

			$data = $this->getData($this->url); 

			$jsonfile = fopen($this->filepathJson, "w+") or die("Unable to open file!");
			fwrite($jsonfile, $data);
			fclose($jsonfile);
		}

		if($data !== false && filesize($this->filepathJson) == 0){
			$data = false; 
		}

		return $data; 
	}

	// Hämtar data från sr api. 
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