<?php

class HTMLView{

	public function echoHTML($content){
		
		if ($content === NULL){
			throw new \Exception("HTMLView::echoHTML does not allow body to be nu" );
		}
			
		echo "
		<!DOCTYPE html>
		<html>
			<head>
			<title>Mashup</title>
			<meta charset ='utf-8' />

			<!-- Latest compiled and minified CSS -->
			<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' 
			integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>

			<link rel='stylesheet' href='http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css' />

			<link rel='stylesheet' type='text/css' href='./css/style.css'>
		</head>
			<body>
				<div class='container-fluid' id='container'>$content</div>
				
				<script src='https://maps.googleapis.com/maps/api/js?key=[key]&callback=initMap'
        		async defer></script>
        		<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        		<script src='./javascript/mashup.js'></script>
			</body>
		</html>";
	}
}