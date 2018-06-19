<?php 

if(ACTIVE_APP == App::get()) {
	return array(
	'count' => 5804
	);
}
else {
	return array(
		'count' => 'null'
	);
}