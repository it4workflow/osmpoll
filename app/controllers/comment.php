<?php namespace controllers;
use core\view,
    DateTime,
    DateInterval;

/*
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
class Comment extends \core\controller{

  private $_comment;

	public function __construct(){
		parent::__construct();
    $this->_comment = new \models\comment();   
	}

  public function poll($frageId) {
    print_r($_REQUEST);
    $comment = $_REQUEST['commenttext'];
    if(!empty($comment)) {
      $values = array( 'frage_id' => $frageId, 'comment' => $comment, 'created_by' => \helpers\session::get('osm_user_display_name'));
      $this->_comment->insertComment($values);
    }
    \helpers\url::redirect('poll/'.$frageId);
  }
  
  public function preview() {
    echo \helpers\parsedown::instance()->parse($_POST['comment']);
  }

}
