<?php
return [
	'settings' => [
		'displayErrorDetails'    => true, // set to false in production
		'addContentLengthHeader' => false, // Allow the web server to send the content-length header
		// Database
		'db'                     => [
			'host'   => '127.0.0.1',
			'user'   => 'root',
			'pass'   => '',
			'dbname' => 'flex-calculator'
		],
		// Renderer settings
		'renderer'               => [
			'template_path' => __DIR__ . '/../templates/',
		],
		// Monolog settings
		'logger'                 => [
			'name'      => 'recipe-api',
			'path'      => __DIR__ . '/../logs/flex.log',
			'level'     => \Monolog\Logger::DEBUG,
			'max_files' => 60
		],
		'google' => [
			'client_id' => '',
			'client_secret' => '',
			'redirect_uri' => ''
		]
	],
];