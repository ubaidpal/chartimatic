<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => 'https://api.mailgun.net/v3/sandbox323f05e4a1094d9ea7285c568c8e2f73.mailgun.org',
		'secret' => 'key-76e45e37f506f7f94dd68791dc01ea62',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],
	'facebook' => [
			'client_id' => '121133804959148',
			'client_secret' => '98e7cf9f4d0b89903b269efc83458910',
			'redirect' => "http://" . $_SERVER['SERVER_NAME'] .'/social/handle/facebook',
	],
	'google' => [
			'client_id' => '558091149383-g0ugrd9kmisbhjdhdg3rsvcqghh1mbuu.apps.googleusercontent.com',
			'client_secret' => '3KY_y-mPXjxEO3JDhJOG3RCO',
			'redirect' =>"http://" . $_SERVER['SERVER_NAME'] . '/social/handle/google',
	]
];
