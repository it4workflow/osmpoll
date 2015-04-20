<?php
if(file_exists('vendor/autoload.php')){
	require 'vendor/autoload.php';
} else {
	echo "<h1>Please install via composer.json</h1>";
	echo "<p>Install Composer instructions: <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
	echo "<p>Once composer is installed navigate to the working directory in your terminal/command promt and enter 'composer install'</p>";
	exit;
}

if (!is_readable('app/core/config.php')) {
	die('No config.php found, configure and rename config.example.php to config.php in app/core.');
}

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
	define('ENVIRONMENT', 'development');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but production will hide them.
 */

if (defined('ENVIRONMENT')){

	switch (ENVIRONMENT){
		case 'development':
			error_reporting(E_ALL);
		break;

		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}

}

//initiate config
new \core\config();

//create alias for Router
use \core\router,
    \helpers\session;

//set language to session
if(!session::get('language')){
  $setlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
  switch ($setlang){
    case "de":
      session::set('language','de');
      break;
    case "en":
      session::set('language','en');
      break;
    default:
      session::set('language','en');
      break;
  }
}

//define routes
if(session::get('logged_in')){
  Router::get('', '\controllers\main@index');
  Router::get('/polls', '\controllers\poll@overview');
  Router::get('/poll/(:num)', '\controllers\poll@show');
  Router::get('/poll/create', '\controllers\poll@create');
  Router::post('/poll/create', '\controllers\poll@savePoll');
  Router::post('/poll/(:num)', '\controllers\poll@answer');
  Router::get('logout', '\controllers\main@logout');
  Router::post('/poll/(:num)/comment', '\controllers\comment@poll');
} else {
  Router::get('', '\controllers\welcome@welcome');
}
Router::get('/language/(:any)', '\controllers\main@language');
Router::get('/impressum', '\controllers\main@impressum');
Router::post('/email', '\controllers\main@emailMessage');
Router::post('/oauth/login', '\controllers\oauth@login');
Router::get('/oauth/callback', '\controllers\oauth@callback');
Router::get('/rss', '\controllers\rss@feed');

//if no route found
//Router::error('\core\error@index');
Router::error('\controllers\welcome@welcome');

//turn on old style routing
Router::$fallback = false;

//execute matched routes
Router::dispatch();
