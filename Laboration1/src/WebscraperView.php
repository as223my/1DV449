<?php

class WebscraperView{

	public function form(){
		$html = 
		"<form method='post' action='index.php'>	
			<p>Ange url:  <input type='text' name='url'> 
			<input type='submit' value='Start!' name='begin' /></p>
    	</form>"; 

    	return $html;
	}

	public function label(){
		$html = "<h1>Följande filmer hittades</h1>";
		return $html;
	}

	public function noDaysFound(){
		$html = "<p><b>Ingen dag passar alla denna vecka!<b></p>";
		return $html;
	}

	public function listOfMovies($movieNames, $movieTimes, $day){
		$html = "<p><ul>";
			for($i=0; $i < count($movieNames); $i++){
				$html .= "<li>Filmen <b>" . $movieNames[$i] . "</b> klockan " . $movieTimes[$i] . " på " . $day . ".</li>";  
			}
			 
		$html .="</ul></p>"; 
		return $html;
	}
}