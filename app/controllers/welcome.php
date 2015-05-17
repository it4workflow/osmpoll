<?php namespace controllers;
use core\view,
    helpers\session;

/*
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
class Welcome extends \core\controller{

	public function __construct(){
		parent::__construct();
	}

	public function welcome() {
    session::set('referrer', $_SERVER['REDIRECT_QUERY_STRING']);
		View::rendertemplate('header', $data);
		View::render('welcome/welcome', $data);
		View::rendertemplate('footer', $data);
	}

}
