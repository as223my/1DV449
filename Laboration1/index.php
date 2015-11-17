<?php

require_once("src/HTMLView.php");
require_once("src/WebscraperController.php");

$controller = new \WebscraperController();
$view = new \HTMLView();

$content = $controller->doWebScrape();

$view->echoHTML($content); 

