<?php

namespace models;

class Hut extends \core\model {

  function __construct() {
    parent::__construct();
  }

  public function getHut($id) {
    return $this->_db->select('SELECT * FROM ' . PREFIX . 'hut WHERE id = :id', array(':id' => $id));
  }

}
