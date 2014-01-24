<?php

define('DS', DIRECTORY_SEPARATOR);
define('BP', dirname(__FILE__));

require BP . '/lib/config.php';
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
