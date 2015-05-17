<?php namespace controllers;

use core\view,
    helpers\session,
    PDOException;

class Hut extends \core\controller{

  private $_hut;

	public function __construct(){
		parent::__construct();
    $this->_hut = new \models\hut();
	}

  public function overview() {
    session::set('referrer', $_SERVER['REDIRECT_QUERY_STRING']);
    $data['overview'] = $this->_hut->getHuts();
    View::rendertemplate('header');
		View::render('hut/overview', $data);
		View::rendertemplate('footer');

  }
  
  public function show($hutId) {
    session::set('referrer', $_SERVER['REDIRECT_QUERY_STRING']);
    $data['hut'] = $this->_hut->getHut($hutId);
    $data['images'] = $this->_hut->getHutImages($hutId);
    $tags = $this->_hut->getHutTagsOrderedByVoting($hutId);
    foreach($tags as $tag) {
      $subtags = $this->_hut->getHutSubTagsOrderedByVoting($tag->id);
      foreach($subtags as $subtag) {
        $subtag->comments = $this->_hut->getHutTagComments($subtag->id);
        $stats = $this->_hut->getHutTagVotesStat($subtag->id);
        foreach ($stats as $stat) {
          if($stat->mode=='up'){
            $subtag->up = $stat->sum;
          } else if ($stat->mode=='down') {
            $subtag->down = $stat->sum;
          }
        }
      }
      $tag->subtags = $subtags;
      $tag->comments = $this->_hut->getHutTagComments($tag->id);
      $stats = $this->_hut->getHutTagVotesStat($tag->id);
      foreach ($stats as $stat) {
        if($stat->mode=='up'){
          $tag->up = $stat->sum;
        } else if ($stat->mode=='down') {
          $tag->down = $stat->sum;
        }
      }
    }
    $data['tags'] = $tags;
    $votes = $this->_hut->getHutTagVotesByUser($hutId, \helpers\session::get('osm_user_id'));
    $uservotes = array();
    foreach($votes as $vote) {
      $uservotes[$vote->hut_tags_id] = $vote->voting;
    }
    $data['uservotes'] = $uservotes;
    $data['comments'] = $this->_hut->getHutComments($hutId);
    
		View::rendertemplate('header');
		View::render('hut/hut', $data);
    View::render('hut/comments', $data);
		View::rendertemplate('footer');

  }

  public function create() {
    $values = array(
      'title' => $_POST['title'],
      'description' => $_POST['description'],
      'created_by' => \helpers\session::get('osm_user_display_name'),
      'created_osmid' => \helpers\session::get('osm_user_id')
    );
    $hutId = $this->_hut->createHut($values);
    \helpers\url::redirect('hut/'.$hutId);
  }
  
  public function addComment($hutId) {
    if(isset($_REQUEST['comment']) && !empty($_REQUEST['comment'])) {
      $values = array(
        'hut_id' => $hutId,
        'comment' => $_REQUEST['comment'], 
        'created_by' => \helpers\session::get('osm_user_display_name'),
        'created_osmid' => \helpers\session::get('osm_user_id')
        );
      $this->_hut->createHutComment($values);
    }
    \helpers\url::redirect('hut/'.$hutId);
  }
  
  public function createTag($hutId) {
    if(isset($_REQUEST['tagkey']) && !empty($_REQUEST['tagkey']) && isset($_REQUEST['tagvalue']) && !empty($_REQUEST['tagvalue'])) {
      $values = array (
        'hut_id' => $hutId,
        'tagkey' => $_REQUEST['tagkey'],
        'tagvalue' => $_REQUEST['tagvalue'],
        'created_by' => \helpers\session::get('osm_user_display_name'),
        'created_osmid' => \helpers\session::get('osm_user_id')
      );
      try{
        $this->_hut->createHutTag($values);
      } catch (PDOException $e) {
        if($e->getCode()!=23000){
          throw $e;
        }
      }
    }
    \helpers\url::redirect('hut/'.$hutId);
  }
  
   public function createSubtag($hutId, $hutTagId) {
    if(isset($_REQUEST['tagkey']) && !empty($_REQUEST['tagkey']) && isset($_REQUEST['tagvalue']) && !empty($_REQUEST['tagvalue'])) {
      $values = array (
        'hut_id' => $hutId,
        'parent_tag_id' => $hutTagId,
        'tagkey' => $_REQUEST['tagkey'],
        'tagvalue' => $_REQUEST['tagvalue'],
        'created_by' => \helpers\session::get('osm_user_display_name'),
        'created_osmid' => \helpers\session::get('osm_user_id')
      );
      try{
        $this->_hut->createHutTag($values);
      } catch (PDOException $e) {
        if($e->getCode()!=23000){
          throw $e;
        }
      }
    }
    \helpers\url::redirect('hut/'.$hutId);
  } 
 
  public function addTagComment($hutId, $hutTagsId) {
    if(isset($_REQUEST['tagcomment']) && !empty($_REQUEST['tagcomment'])) {
      $values = array(
        'hut_tags_id' => $hutTagsId,
        'comment' => $_REQUEST['tagcomment'], 
        'created_by' => \helpers\session::get('osm_user_display_name'),
        'created_osmid' => \helpers\session::get('osm_user_id')
        );
      $this->_hut->createHutTagComment($values);
    }
    \helpers\url::redirect('hut/'.$hutId);
    
  }
  
  public function voteUp($hutId, $hutTagsId) {
    $this->vote($hutId, $hutTagsId, 1);
  }
  
  public function voteDown($hutId, $hutTagsId) {
    $this->vote($hutId, $hutTagsId, -1);
  }  
  
  public function deleteVote($hutId, $hutTagsId) {
    $where = array (
      'hut_tags_id' => $hutTagsId,
      'created_osmid' => \helpers\session::get('osm_user_id')
    );
    $this->_hut->deleteHutTagVoting($where);
    \helpers\url::redirect('hut/'.$hutId);    
  }
  
  private function vote($hutId, $hutTagsId, $vote) {
    $where = array (
      'hut_tags_id' => $hutTagsId,
      'created_osmid' => \helpers\session::get('osm_user_id')
    );
    $this->_hut->deleteHutTagVoting($where);
    
    $values = array(
      'hut_tags_id' => $hutTagsId,
      'voting' => $vote,
      'created_by' => \helpers\session::get('osm_user_display_name'),
      'created_osmid' => \helpers\session::get('osm_user_id')
    );
    $this->_hut->createHutTagVoting($values);
    \helpers\url::redirect('hut/'.$hutId);    
  }
  
}
