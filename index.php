<?php

define('BASE_DIR', getcwd());
define('FRAMEWORK_DIR', getcwd().'/framework');

//start
require './framework/starter.php';
$app = new HowdyEngine(require('settings.php'));

