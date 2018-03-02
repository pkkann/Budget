<?php
$GLOBALS['base_url'] 				= "http://localhost/xampp/budget/public_html";

$GLOBALS['defaultRoute'] 			= array("login", "index");

$GLOBALS['debug'] 					= true;

$GLOBALS['autoload']['helpers'] 	= array();

$GLOBALS['mysql'] 					= array(
					'host' => 'localhost',
					'port' => 3306,
					'user' => 'root',
					'pass' => 'secret',
					'db' => 'budget'
);