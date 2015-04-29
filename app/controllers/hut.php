<?php namespace controllers;

use core\view;

class Hut extends \core\controller{

  private $_hut;

	public function __construct(){
		parent::__construct();
    $this->_hut = new \models\hut();
	}

  public function overview() {

    $data['overview'] = $this->_hut->getHuts();
    View::rendertemplate('header');
		View::render('hut/overview', $data);
		View::rendertemplate('footer');

  }
  
  public function show($hutId) {

    $data['hut'] = $this->_hut->getHut($hutId);
    $data['tags'] = $this->_hut->getHutTagsOrderedByVoting($hutId);
    $votes = $this->_hut->getHutTagVotesByUser($hutId, \helpers\session::get('osm_user_id'));
    $uservotes = array();
    foreach($votes as $vote) {
      $uservotes[$vote->hut_tags_id] = $vote->voting;
    }
    $data['votes'] = $uservotes;
    $data['comments'] = $this->_hut->getHutComments($hutId);
    
		View::rendertemplate('header');
		View::render('hut/hut', $data);
    View::render('hut/tags', $data);
    View::render('hut/comments', $data);
		View::rendertemplate('footer');

  }

  public function addComment($hutId) {
    $values = array(
      'hut_id' => $hutId,
      'comment' => $_REQUEST['comment'], 
      'created_by' => \helpers\session::get('osm_user_display_name'),
      'created_osmid' => \helpers\session::get('osm_user_id')
      );
    $this->_hut->createHutComment($values);
    \helpers\url::redirect('hut/'.$hutId);
  }
  
}
