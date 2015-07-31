<?php

/**
 * Configures default file logging options
 */
// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));


/**
 * 環境切り替え
 * development	- Minibird
 * staging		- Heroku
 * production	- Heroku
 */
if(getenv('HEROKU_APP_ENVIRONMENT') == 'production') {
	Configure::write('environment', 'production');
} else if(getenv('HEROKU_APP_ENVIRONMENT') == 'staging') {
	Configure::write('environment', 'staging');
} else {
	Configure::write('environment', 'development');
}



/**
 * Configures default file logging options
 */
CakePlugin::loadAll();
CakePlugin::load('Redis');


/**
 * Configures default file logging options
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));


/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
