<?php

namespace models;

class Hut extends \core\model {

  function __construct() {
    parent::__construct();
  }

  public function getHuts() {
    return $this->_db->select('SELECT * FROM ' . PREFIX . 'hut ORDER BY created DESC');
  }
  
  public function getHut($id) {
    return $this->_db->select('SELECT * FROM ' . PREFIX . 'hut WHERE id = :id', array(':id' => $id));
  }

  public function getHutImages($id) {
    return $this->_db->select('SELECT * FROM ' . PREFIX . 'hut_image WHERE hut_id = :hutId', array(':hutId' => $id));
  }
  
  public function createHut($values) {
    $this->_db->insert(PREFIX.'hut',$values);
    return $this->_db->lastInsertId('id');
  }
  
  public function getHutComments($hutId) {
    return $this->_db->select('SELECT * FROM ' . PREFIX . 'hut_comment WHERE hut_id = :hutId', array(':hutId' => $hutId));
  }
  
  public function createHutComment($values) {
    $this->_db->insert(PREFIX.'hut_comment', $values);
  }
  
  public function getHutTagsOrderedByVoting($hutId) {
    return $this->_db->select('SELECT tags.*, IFNULL(sum(vote.voting), 0) as votes FROM '.PREFIX.'hut_tags tags LEFT JOIN '.PREFIX.'hut_tags_voting vote ON vote.hut_tags_id=tags.id WHERE tags.hut_id = :hutId GROUP BY tags.id ORDER BY votes DESC', array(':hutId' => $hutId));
  }
  
  public function createHutTag($values) {
    $this->_db->insert(PREFIX.'hut_tags', $values);
  }
  
  public function createHutTagVoting($values) {
    $this->_db->insert(PREFIX.'hut_tags_voting', $values);
  }
  
  public function deleteHutTagVoting($where) {
    $this->_db->delete(PREFIX.'hut_tags_voting', $where);
  }
  
  public function getHutTagVotesByUser($hutId, $createdOsmId) {
    return $this->_db->select('SELECT vote.hut_tags_id, voting FROM '.PREFIX.'hut_tags tags JOIN '.PREFIX.'hut_tags_voting vote ON vote.hut_tags_id=tags.id AND tags.hut_id = :hutId WHERE vote.created_osmid = :createdOsmId', array(':hutId' => $hutId, ':createdOsmId' => $createdOsmId));
  }
  
  public function getHutTagVotesStat($hutTagId) {
    return $this->_db->select('select "up" as mode, ifnull(sum(voting),0) as sum from hut_tags_voting where hut_tags_id=:hutTagId and voting>0 union select "down" as mode, ifnull(sum(voting),0) from hut_tags_voting where hut_tags_id=:hutTagId and voting<0', array(":hutTagId" => $hutTagId));
  }
  
  public function getHutTagComments($hutTagId) {
    return $this->_db->select('SELECT * FROM '.PREFIX.'hut_tags_comment WHERE hut_tags_id = :hutTagId ORDER BY created', array(':hutTagId' => $hutTagId));
  }
  
  public function createHutTagComment($values) {
    $this->_db->insert(PREFIX.'hut_tags_comment', $values);
  }
  
}
