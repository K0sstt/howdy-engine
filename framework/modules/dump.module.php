<?php 

function dump($what, $exit = false) {
	echo '<pre>';
	var_dump($what);
	echo '</pre>';

	if($exit)
		exit;
}