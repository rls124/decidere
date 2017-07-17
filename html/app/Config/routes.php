<?php

	Router::connect('/', array('controller' => 'Home', 'action' => 'index'));

	Router::parseExtensions('json', 'xml', 'html');

	CakePlugin::routes();

	//CakePlugin::routes('Blog'); // Load Blog plugin routes
	//CakePlugin::routes('lil_blogs'); // Load Blog plugin routes

	require CAKE . 'Config' . DS . 'routes.php';

 ?>
 
 
 