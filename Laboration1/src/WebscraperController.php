<?php

require_once("./src/Webscraper.php");
require_once("./src/WebscraperView.php");
	
class WebscraperController{

	private $webscraper; 
	private $webscraperView; 

	private $okDays;
	private $movieNames;  
	private $moveTime; 
	private $html; 
	
	public function __construct(){
		
		$this->webscraper = new \Webscraper();
		$this->webscraperView = new \WebscraperView();

		$this->movieNames = array(); 
		$this->movieTime = array(); 
		$this->okDays = array();

	}
	
	public function doWebScrape(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['url'] !== ""){

			$url = $_POST['url'];

			// Hämtar ut adressen till webbsidor.  
			$links = $this->webscraper->getLinksFromUrl($url); 

			foreach ($links as $link) {

				// Tar bort / från länkarna. 
				$newLink = str_replace("/", "", $link->nodeValue);

				if($newLink == "calendar"){

					// Hämtar information om vilka dagar som personerna är lediga. 
					$days = $this->webscraper->checkCalendar($url, $newLink . "/");

					// Om alla tre är lediga på samma dag, läggs dagen till i arrayen okDays. 
					foreach ($days as $day => $number) {
						if($number == 3){
							array_push($this->okDays, $day);

						}
					}

					// Om ingen dag i veckan passar alla tre. 
					if(count($this->okDays) == 0){
						$this->html .= $this->webscraperView->form();
						$this->html .= $this->webscraperView->noDaysFound();
						return $this->html;
					}

				}else if($newLink == "cinema"){

					$this->html .= $this->webscraperView->form();
					$this->html .= $this->webscraperView->label();

					// Loopar igenom de lediga dagarna (dagen), och hämtar ut de filmer som går på respektive dag. 
					for($i=0; $i < count($this->okDays); $i++){

						$movieResult = $this->webscraper->checkCinema($url, $newLink . "/", $this->okDays[$i]);

						// Loopar igenom film, för film. Det finns 3 olika start tider för varje film.
						foreach ($movieResult as $key => $value) {

							for($j=0; $j < 3; $j++){

								// Om lediga platser finns kvar att boka till filmen, läggs information om namn och tid till i arrayer. 
								if($value[$j]['status'] != 0){
									array_push($this->movieNames, $value[$j]['movie']);
									array_push($this->movieTime, $value[$j]['time']);
								}
							}
						}
						
						// Lägger till lista över filmer för varje ledig dag. 
						$this->html .= $this->webscraperView->listOfMovies($this->movieNames, $this->movieTime, $this->okDays[$i]);

						unset($this->movieNames);
						unset($this->movieTime);
						$this->movieNames = array();
						$this->movieTime = array();
					}
				}
			}
			
			return $this->html;

		}else{

			return $this->webscraperView->form(); 
		}
	}
}
