<?php

define('DS', DIRECTORY_SEPARATOR);
define('BP', dirname(__FILE__));

if($_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == '192.168.0.130') {
	define('ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Intranet/php/');
} else {
	define('ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
}

if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
	define('ROOT_DIR', dirname($_SERVER['SCRIPT_NAME']) . '/');
} else {
	define('ROOT_DIR', dirname($_SERVER['SCRIPT_NAME']));
}

require BP . '/lib/Autoload.php';

Autoload::register();

// Get the controller
//Selectic::getController();

$template = new Selectic_Template();

if( !empty($_REQUEST['content']) ) {
	$template->setContent($_REQUEST['content']);
}

if( !empty($_REQUEST['layout']) ) {
	$template->setLayout($_REQUEST['layout']);
}

$template->render();
$template->display();
