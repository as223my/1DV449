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

				<link rel='stylesheet' type='text/css' href='./css/style.css'>
			</head>
			<body>
				<div class='container-fluid' id='container'>$content</div>
				
				<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBUUC0qK1fi9rmOeb9zHEF-Jb_LpQbrqQ0'
        		async defer></script>
        		<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        		<script src='./javascript/mashup.min.js'></script>
			</body>
		</html>";
	}
}