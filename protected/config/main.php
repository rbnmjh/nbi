<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'NBI Nepal',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'sailendra',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		         'admin' => array('defaultController' => 'admin'),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'class' => 'WebUser',
			'authTimeout' => 43200,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'caseSensitive' => false,
			'rules'=>array(
                    '<controller:admin>/<action:\w+>/<id:\d+>' => 'admin/admin/<action>',
                    '<controller:admin>/<action:\w+>' => 'admin/admin/<action>',    
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<slug:[\w-]+>' => '<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=nbi',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),

		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'sailendra.shakya@hotmail.com',
	),
);
