<?php

function render($view, $vars = array()) {
	// Create loader
	$loader = new Twig_Loader_Filesystem(TEMPLATES_DIR);

	// Extend paths
	$loader->addPath(TEMPLATES_DIR.'/'.ACTIVE_APP);

	// Create enviroment
	$twig = new Twig_Environment($loader, array(
		// 'cache' => TWIG_CACHE_DIR,
	));

	// Connect twig extensions
	$extensions = glob(TWIG_EXTENSIONS_DIR.'/*.twig.php');
	foreach($extensions as $extension) {
		require $extension;
		$extension_class_name = '\\Twig_Extensions\\'.ucfirst(strtolower(str_replace('.twig.php', '', basename($extension)))).'_Twig_Extension';
		$twig->addExtension(new $extension_class_name());
	}

	render_extend_vars($vars);

	// Render template
	$template = $twig->loadTemplate($view.'.html');
	$template->display($vars);
}

function render_url($view, $vars = array()) {
	return array(
		'view' => $view,
		'vars' => $vars);
}

function render_extend_vars(&$vars) {
	$vars['app']['settings'] = require BASE_DIR.'/settings.php';

	foreach($vars['app']['settings']['apps'] as $iterable_app) {
		$twig_app_extend = BASE_DIR.'/apps/'.$iterable_app.'/twig.php';
		if(file_exists($twig_app_extend)) {
			App::set($iterable_app);
			$vars['apps'][$iterable_app] = require $twig_app_extend;
		}
	}
}