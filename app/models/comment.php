<?php namespace models;
class Comment extends \core\model {
	
	function __construct(){
		parent::__construct();
	}

  public function getComments($frageId){
    return $this->_db->select('SELECT id, comment, created_by, created FROM '.PREFIX.'poll_comments WHERE frage_id = :id AND active=1 ORDER BY created', array(':id' => $frageId));
  }

  public function inactivateComments($frageId){
    $values = array ('active' => 0);
    $where = array ('frage_id' => $frageId);
    $this->_db->update(PREFIX.'poll_comments', $values, $where);
  }

  public function insertComment($values) {
    $this->_db->insert(PREFIX.'poll_comments', $values);
  }

}
