<?php namespace controllers;
use core\view;

/*
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
class Rss extends \core\controller{

  private $_poll;

	public function __construct(){
		parent::__construct();
    $this->_poll = new \models\poll();    
	}

  public function feed(){
    $this->feedLanguage("");
  }

  public function feedLanguage($language = "en"){

    $polls = $this->_poll->getPollsOpen($language);

    $pollsrss = array();
    foreach ($polls as $poll) {
      array_push($pollsrss, array ('poll'=>$poll, 'answers' => $this->_poll->getAnswers($poll->id)));
    }

    $data['polls'] = $pollsrss;
    $data['language'] = empty($language)?"en":$language;
    
		View::render('rss/xml', $data);

  }
  
}
