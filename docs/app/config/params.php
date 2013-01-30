<?php

// application parameters
return array(
	'app.name' => 'Yiistrap',
	// url rules
	'urlManager.rules' => array(
		// default rules
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	),
	// less compiler configurations
	'less.mode' => 'client',
	'less.options' => array(
		'env' => 'development',
		'watch' => true,
	),
	'less.files' => array(
		'less/main.less' => 'css/main.css',
	),
);