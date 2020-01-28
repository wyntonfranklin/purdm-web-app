<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Purdm',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool

	),
	'components'=>array(
		'user'=>array(
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
			    '/' => '/dashboard/',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>require(dirname(__FILE__).'/database.php'),
		'errorHandler'=>array(
			'errorAction'=>YII_DEBUG ? null : 'site/error',
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

	),
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'setup' => 'false'
	),
);
