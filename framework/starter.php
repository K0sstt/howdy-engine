<?php
// Require system classes
require(FRAMEWORK_DIR.'/core/system/base_controller.php');
require(FRAMEWORK_DIR.'/core/system/controller.php');

// Require composer
if(file_exists(FRAMEWORK_DIR.'/core/composer/vendor/autoload.php')) {
	require FRAMEWORK_DIR.'/core/composer/vendor/autoload.php';
}

// Few constant
define('TWIG_CACHE_DIR', FRAMEWORK_DIR.'/cache');
define('APPS_DIR', BASE_DIR.'/apps');
define('TEMPLATES_DIR', BASE_DIR.'/templates');
define('MODULES_DIR', FRAMEWORK_DIR.'/modules');
define('TWIG_EXTENSIONS_DIR', MODULES_DIR.'/twig_extensions');

// Connect modules
$modules = glob(FRAMEWORK_DIR.'/modules/*.module.php');
foreach ($modules as $module) {
	require $module;
}

// Start
require(FRAMEWORK_DIR.'/core/bootstrap.php');