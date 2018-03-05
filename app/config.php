<?php
$GLOBALS['base_url'] 				= "http://localhost/Projects/budget/public_html";

$GLOBALS['defaultRoute'] 			= array("budgets", "index_view");

$GLOBALS['debug'] 					= true;

$GLOBALS['autoload']['helpers'] 	= array();

$GLOBALS['mysql'] 					= array(
					'host' => 'localhost',
					'port' => 3306,
					'user' => 'root',
					'pass' => '',
					'db' => 'budget'
);