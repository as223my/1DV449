<?php

class MashupView{

	public function content(){

		$html = "<h1>Trafikinformation</h1>
		<div class='col-md-6' id='choice'>
			<h2>Visa</h2>
			<button type='button' class='btn btn-default' id='roadTraffic'>Vägtrafik</button>
			<button type='button' class='btn btn-default' id='publicTransport'>Kollektivtrafik</button>
			<button type='button' class='btn btn-default' id='plannedInterference'>Planerad störning</button>
			<button type='button' class='btn btn-default' id='other'>Övrigt</button>
			<button type='button' class='btn btn-default' id='allCategories'>Alla kategorier</button>	
			<div id='list'>
				<ul></ul>
			</div>
		</div>
		<div class='col-md-6' id='map'></div>"; 

		return $html;
	}
}