<?php
define('DS', DIRECTORY_SEPARATOR); // oprendszere válogatja
define('APP_ROOT', __DIR__ . DS); // definiáltuk a gyökérkönyvtárat

// composer autoload betöltése
require __DIR__ . '/vendor/autoload.php';

// autoloader betöltése
//include_once('system/autoloader_new.php');

// alkalmazás indítás
include_once('system/boot.php');

/*
	// checking for minimum PHP version
	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
	    exit('Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !');
	}
*/
?>