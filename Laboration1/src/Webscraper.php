<?php

class Webscraper{

	private $friday;
	private $saturday;
	private $sunday;

	private $movie1;
	private $movie2;
	private $movie3;

	public function __construct(){
		$this->friday = "fredag"; 
		$this->saturday = "lördag"; 
		$this->sunday = "söndag";

		$this->movie1 = "Söderkåkar";
		$this->movie2 = "Fabian Bom"; 
		$this->movie3 = "Pensionat Paradiset"; 
	}

	// Hämtar ut addressen till de tre länkar som finns på första webbsidan. 
	public function getLinksFromUrl($url){
		$data = $this->getData($url); 

		$links = $this->getContentHref($data);
		return $links;
		
	}

	// Hämtar ut information om vilka dagar som personerna är lediga på. 
	public function checkCalendar($url, $link){
		$count = 0; 
		$daysNumber = array(); 
		$days = array("fredag"=>"0", "lördag"=>"0", "söndag"=>"0"); 

		$data = $this->getData($url . $link);
	
		$links = $this->getContentHref($data);
		

		foreach ($links as $newlink) {
			$calendarData[$count] = $this->getData($url . $link . $newlink->nodeValue);
			$daysNumber = $this->getContentCalendar($calendarData[$count]);

			foreach ($daysNumber as $day) {
				if($day === 1){
					$days[$this->friday] += 1; 

				}else if($day === 2){
					$days[$this->saturday] += 1; 

				}else if($day === 3){
					$days[$this->sunday] += 1; 
				}
			}
			$count += 1; 
		}

		return $days;
	}

	// Hämtar ut information om vilka filmer som går på bion. 
	public function checkCinema($url, $link, $day){
		$dayNumber; 
		$movieResults = array(); 

		if($day == $this->friday){
			$dayNumber = "01"; 
		}else if($day == $this->saturday){
			$dayNumber = "02";
		}else if($day == $this->sunday){
			$dayNumber = "03";
		}

		for($i=1; $i <= 3; $i++){

			$newUrl = $url . $link . "check?day=" . $dayNumber . "&movie=0" . $i;

			$data = $this->getData($newUrl);
			$result = json_decode($data, true);

			for($j=0; $j <= 2; $j++){

				if($result[$j]['movie'] == "01"){
					$result[$j]['movie'] = $this->movie1;
				}else if($result[$j]['movie'] == "02"){
					$result[$j]['movie'] = $this->movie2;
				}else if($result[$j]['movie'] == "03"){
					$result[$j]['movie'] = $this->movie3;
				}
			}
			
			$movieResults[$i-1] = $result;
		}

		return $movieResults;
		
	}

	// Skrapar webbsidan.
	public function getData($url){
		
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

	// Hämtar ut information från den skrapade datan. 
	public function getContentHref($data){

		$links = array();
		
		$dom = new \DOMDocument(); 
	
		// laddar $data som html. 
		if($dom->loadHTML($data)){
				
			$xpath = new \DOMXPath($dom); 
				
			// letar upp alla li taggar, i li leta efter a-tagg, välj värdet för href.
			$links = $xpath->query('//li//a/@href');
			return $links; 
		
		} else{
			die("Fel vid inläsning av HTML"); 
		}
	}

	public function getContentCalendar($data){

		$days = array();
		
		$dom = new \DOMDocument(); 
	
		// laddar $data som html. 
		if($dom->loadHTML($data)){
				
			$xpath = new \DOMXPath($dom); 

			for ($i=1; $i <= 3; $i++) {
				$day = $xpath->query("//table//tr/td[$i]");
				foreach ($day as $value) {
					if(strtolower($value->nodeValue) == "ok"){
						array_push($days, $i);
					}
				}
			}
			
			return $days;
		
		} else{
			die("Fel vid inläsning av HTML"); 
		}
	}
}