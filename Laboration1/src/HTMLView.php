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
			<title>Webscraper</title>
			<meta charset ='utf-8' />
			</head>
			<body>
				<div>$content</div>
			</body>
		</html>";
	}
}