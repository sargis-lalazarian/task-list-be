<?php
define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . 'Config/core.php');

require(ROOT . 'router.php');
require(ROOT . 'request.php');
require(ROOT . 'dispatcher.php');

// Start a Session
if (!session_id()) @session_start();

// Initialize Composer Autoload
require_once ROOT . 'vendor/autoload.php';

$dispatch = new Dispatcher();
$dispatch->dispatch();
