<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap',dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Quiz',
	'charset'=>'UTF-8',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl'       => 'facecontrol',
		),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<lang:\w{2}>/<view:(thanks)>'=>'site/page',
				'<lang:\w{2}>/<action:\w+>'=>'site/<action>',
				'admin'=>'admin/login',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<action:\w+>'=>'site/<action>',
			),
		),

        'cache'=>array(
            'class'=>'system.caching.CFileCache',
            'cacheFileSuffix'=>'_poll',
        ),

        'dbCache'=>array(
            'class'=>'system.caching.CDbCache',
        ),

		'db'=>array(
            'class'=>'application.components.DemoModeDbConnection', // Supports demo-mode db cdn
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/poll.db',
            'initSQLs' => array(
                'PRAGMA foreign_keys = ON', // Enables SQLite foreign key support
            ),
			'tablePrefix'=>'tbl_',
            'schemaCacheID'=>'dbCache',
            'schemaCachingDuration'=>1*60*60,
		),
		
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
			),
		),

        'clientScript'=>array(
            'scriptMap'=>array(
                'jquery.js'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
                'jquery.min.js'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
            ),
            'packages' => include dirname(__FILE__).'/jsPackages.php',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
		'languages'  => array('lv', 'ru'),
	),
);