<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Purdm Console',

	// preloading 'log' component
	'preload'=>array('log'),

    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
    ),

	// application components
	'components'=>array(

		// database settings are configured in database.php
        'db'=>require(dirname(__FILE__).'/database.php'),

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
        'adminEmail'=>'wfdevservices@gmail.com',
        'phpass'=>array(
            'iteration_count_log2'=>8,
            'portable_hashes'=>false,
        ),
    ),
);
