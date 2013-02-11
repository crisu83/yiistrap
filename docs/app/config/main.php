<?php

// define the bootstrap alias to point to the document root.
Yii::setPathOfAlias('bootstrap',
        realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'));

// require application params
$params = require(__DIR__ . '/params.php');

// application configuration
return array(
	'basePath' => realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'),

	// application name
	'name' => $params['app.name'],

	// application language
	'language' => 'en',

	// components to preload
	'preload' => array('log'),

	// paths to import
	'import' => array(
		'application.models.*',
		'application.components.*',
		'bootstrap.helpers.*',
	),

	// application components
	'components' => array(
		'bootstrap' => array(
			'class' => 'bootstrap.components.TbApi',
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'less' => array(
			'class' => 'ext.less.components.Less',
			'mode' => $params['less.mode'],
			'options' => $params['less.options'],
			'files' => $params['less.files'],
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'caseSensitive'=>false,
			'rules' => $params['urlManager.rules'],
		),
		'user' => array(
			'allowAutoLogin' => true,
		),
	),

	// application parameters
	'params' => $params,
);