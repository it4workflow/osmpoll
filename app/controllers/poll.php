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
class Poll extends \core\controller{

  private $_poll;
  private $_comment;

	public function __construct(){
		parent::__construct();
    $this->_poll = new \models\poll();
    $this->_comment = new \models\comment();   
	}

  public function overview(){

    $data['polls'] = $this->_poll->getPolls();
    
		View::rendertemplate('header');
		View::render('poll/overview', $data);
		View::rendertemplate('footer');

  }

	public function show($id, $message="") {

    $poll = $this->_poll->getPoll($id)[0];
    $now = new DateTime("now");
    $startdate = new DateTime($poll->startdate);
    $enddate = new DateTime($poll->enddate);

    $data['message'] = $message;
    $data['user_displayname'] = $poll->created_by;
    $data['answered'] = count($this->_poll->hasAnswered($id, \helpers\session::get('osm_user_id')))==1;
    $data['draftmode'] = $startdate == $enddate;
    $data['closed'] = $now >= $enddate && !$data['draftmode'];
    $data['answers'] = $this->_poll->getAnswers($id);
    $data['question'] = $poll;
    $data['donut'] = $this->_poll->getDonut($id);
    $data['stacked'] = $this->_poll->getStacked($id);
    $data['timeseries'] = $this->_poll->getTimeSeries($id);
    $data['comments'] = $this->_comment->getComments($id);

    if($data['draftmode'] && \helpers\session::get('osm_user_display_name') == $poll->created_by) {
      View::rendertemplate('header', $data);
      View::render('poll/create', $data);
      View::rendertemplate('footer', $data);
    } else {
      View::rendertemplate('header', $data);
      View::render('poll/show', $data);
      View::rendertemplate('footer', $data);
    }
	}

  public function answer($id) {

    if ( isset($_REQUEST['answer']) || isset($_REQUEST['abstain']) ) {
      
      $answered['frage_id'] = $id;
      $answered['user_id']= \helpers\session::get('osm_user_id');
      $this->_poll->saveAnswered($answered);

      $answer['frage_id'] = $id;
      $answer['antwort_id'] = isset($_REQUEST['answer']) && !isset($_REQUEST['abstain']) ? $_REQUEST['answer'] : 0;
      $answer['user_id'] = $_REQUEST['anonym'] ? 0 : \helpers\session::get('osm_user_id');
      $answer['changesets'] = \helpers\session::get('osm_user_changesets');
      $answer['account_created'] = \helpers\session::get('osm_user_account_created');
      $this->_poll->saveAnswer($answer);
      
      $this->show($id, array("type"=>"success", "text"=>\core\language::show('thank_for_answer','poll', \helpers\session::get('language'))));
    } else {
      $this->show($id, array("type"=>"danger", "text"=>\core\language::show('choose_an_answer','poll', \helpers\session::get('language'))));
    }
  }

  public function create() {
    View::rendertemplate('header', $data);
		View::render('poll/create', $data);
		View::rendertemplate('footer', $data);
  }

  public function savePoll() {

    $id=0;

    if(isset($_REQUEST['id'])){
      $id = $_REQUEST['id'];
      $poll['frage'] = $_REQUEST['frage'];
      $poll['description'] = $_REQUEST['frage_description'];
      $this->_poll->updatePoll($poll, array('id' => $id));
    } else {
      $poll['frage'] = $_REQUEST['frage'];
      $poll['description'] = $_REQUEST['frage_description'];
      $poll['created_by'] = \helpers\session::get('osm_user_display_name');
      $poll['created_by_osmid'] = \helpers\session::get('osm_user_id');
      $id = $this->_poll->createPoll($poll);
    }

    $answers = array();
    $answer = array ('frage_id' => $id, 'id' => 0, 'antwort' => 'Enthaltung');
    array_push($answers, $answer);
    for( $i=1; $i<=10; $i++ ) {
      if (isset($_REQUEST['antwort_'.$i]) && !empty($_REQUEST['antwort_'.$i]) ) {
        $answer = array ('frage_id' => $id, 'id' => $i, 'antwort' => $_REQUEST['antwort_'.$i], 'description' => $_REQUEST['answer_description_'.$i]);
        array_push($answers, $answer);
      } else {
        break;
      }
    }

    $this->_poll->deleteAnswers(array('frage_id'=>$id));
    $this->_poll->createAnswers($answers);

    if(isset($_REQUEST['start'])) {
      $today = new DateTime();
      $values = array (
        'startdate' => $today->format('Y-m-d 00:00:00'),
        'enddate' => $today->add(new DateInterval('P30D'))->format('Y-m-d 00:00:00')
      );
      $where = array ('id' => $id);
      $this->_poll->startPoll($values, $where);
      $this->_comment->inactivateComments($id);
    }
    
    \helpers\url::redirect('');
  }

}
