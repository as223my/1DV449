<?php

require_once("src/view/HTMLView.php");
require_once("src/controller/MashupController.php");

$controller = new \MashupController();
$view = new \HTMLView();

$content = $controller->srTrafficInformation();

$view->echoHTML($content); 

