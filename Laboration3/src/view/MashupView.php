<?php

class MashupView{

	public function content($message){

		$html = "<h1>Trafikinformation</h1>
		<div class='col-xs-6' id='choice'>
			<h2>Visa</h2>
			<button type='button' class='btn btn-default' id='allCategories'>Alla kategorier</button>
			<button type='button' class='btn btn-default' id='roadTraffic'>Vägtrafik</button>
			<button type='button' class='btn btn-default' id='publicTransport'>Kollektivtrafik</button>
			<button type='button' class='btn btn-default' id='plannedInterference'>Planerade störningar</button>
			<button type='button' class='btn btn-default' id='other'>Övrigt</button>

			<div id='list'>
				<noscript>Din webbläsare verkar inte stödja JavaScript, var vänligen aktivera detta för att kunna använda applikationen!</noscript>
				<p id='message'>$message</p>
				<ul></ul>
			</div>
		</div>

		<div class='col-xs-6' id='map'></div>"; 

		return $html;
	}
}