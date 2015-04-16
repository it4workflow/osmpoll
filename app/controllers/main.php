<?php namespace controllers;
use core\view;

/*
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
class Main extends \core\controller{

  private $_polls;

	public function __construct(){
		parent::__construct();
    $this->_polls = new \models\poll();
	}

	public function index($message="") {

    $data['open'] = $this->_polls->getPollsOpen(\helpers\session::get('osm_user_id'));
    $data['closed'] = $this->_polls->getPollsClosed();
    $data['message'] = $message;
    
		View::rendertemplate('header', $data);
		View::render('main/dashboard', $data);
		View::rendertemplate('footer');
	}

  public function impressum($message="") {

    $data['message'] = $message;
    
    View::rendertemplate('header', $data);
    View::render('main/impressum');
    View::rendertemplate('footer');
  }

  public function logout() {
    \helpers\session::destroy();
    \helpers\url::redirect('');
  }
  
  public function emailMessage() {
    if(isset($_POST['url']) && $_POST['url'] == ''){

      // put your email address here
      $youremail = 'osm@haraldhartmann.de';

      // prepare a "pretty" version of the message
      // Important: if you added any form fields to the HTML, you will need to add them here also
      $body = "Folgende Anfrage wurde ueber das Kontaktformular abgesendet:

  Name:  $_POST[absender]
  E-Mail: $_POST[email]
  Message: $_POST[nachricht]";

      // Use the submitters email if they supplied one
      // (and it isn't trying to hack your form).
      // Otherwise send from your email address.
      if( $_POST['email'] && !preg_match( "/[\r\n]/", $_POST['email']) ) {
        $headers = "From: $_POST[email]";
      } else {
        $headers = "From: $youremail";
      }

      // finally, send the message
      mail($youremail, 'Umfrageplattform Feedback', $body, $headers );
    }
    $this->impressum(array("type"=>"success", "text"=>\core\language::show('thanks_for_feedback','main', \helpers\session::get('language'))));
  }


}
