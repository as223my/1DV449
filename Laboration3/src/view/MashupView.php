<?php

class MashupView{

	public function content(){

		$html = "<h1>Trafikinformation</h1>
		<div class='col-md-6' id='choice'>
			<h2>Filtrera på</h2>
			<button type='button' class='btn btn-default' id='b'>Vägtrafik</button>
			<button type='button' class='btn btn-default'>Kollektivtrafik</button>
			<button type='button' class='btn btn-default'>Planerad störning</button>
			<button type='button' class='btn btn-default'>Övrigt</button>
			<button type='button' class='btn btn-default'>Alla kategorier</button>
			<div id='list'>
			<button type='button' class='btn btn-default' id='HEJ'>HEJ</button></div>
		</div>
		<div class='col-md-6' id='map'></div>"; 

		return $html;
	}
}