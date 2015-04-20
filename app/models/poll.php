<?php namespace models;
class Poll extends \core\model {
	
	function __construct(){
		parent::__construct();
	}

  public function getPoll($id){
    return $this->_db->select('SELECT id, frage, created, created_by FROM '.PREFIX.'fragen WHERE id = :id', array(':id' => $id));
  }

  public function getPolls($limit=false){
    return $this->_db->select('SELECT id, frage, created, created_by FROM '.PREFIX.'fragen ORDER BY created DESC'. ($limit ? ' LIMIT 10' : ''));
  }

  public function getPollsOpen($user_id=0){
    return $this->_db->select('SELECT id, frage, fragen.created, created_by, startdate, enddate, count(stimmen.frage_id) as count,	not isnull(answered.frage_id) as answered FROM '.PREFIX.'fragen LEFT JOIN '.PREFIX.'stimmen ON stimmen.frage_id=fragen.id LEFT JOIN '.PREFIX.'answered ON answered.frage_id=fragen.id AND answered.user_id=:user_id WHERE startdate<=NOW() AND enddate>NOW() GROUP BY fragen.id ORDER BY enddate ASC', array(':user_id'=>$user_id));
  }

  public function getPollsClosed(){
    return $this->_db->select('SELECT id, frage, fragen.created, created_by, startdate, enddate, count(stimmen.frage_id) as count FROM '.PREFIX.'fragen LEFT JOIN '.PREFIX.'stimmen ON stimmen.frage_id=fragen.id WHERE enddate<NOW() GROUP BY fragen.id ORDER BY created DESC');
  }

  public function getUnanswered($user_id){
    return $this->_db->select('SELECT fragen.id, frage, created, created_by, startdate, enddate FROM fragen LEFT JOIN answered ON answered.frage_id=fragen.id AND answered.user_id=:user_id WHERE startdate<=NOW() AND enddate>NOW() AND answered.frage_id IS NULL ORDER BY created', array(':user_id'=>$user_id));
  }

  public function getAnswers($id){
    return $this->_db->select('SELECT id, antwort, description FROM '.PREFIX.'antworten WHERE frage_id = :id AND id>0 ORDER BY id', array(':id' => $id));
  }

  public function getDonut($id){
    return $this->_db->select('SELECT stimmen.frage_id, stimmen.antwort_id, antwort, COUNT(stimmen.frage_id) as count FROM stimmen JOIN antworten ON antworten.frage_id=stimmen.frage_id AND antworten.id=stimmen.antwort_id WHERE stimmen.frage_id = :id GROUP BY stimmen.frage_id, stimmen.antwort_id ORDER BY antworten.id', array(':id' => $id));
  }

  public function getStacked($id){
    $result = $this->_db->select("select * from (
    select 'Gold' as mappertype, antworten.id, antwort, count(stimmen.antwort_id) as count from stimmen JOIN antworten ON antworten.frage_id=stimmen.frage_id AND antworten.id=stimmen.antwort_id where stimmen.frage_id = :id AND stimmen.changesets>=2000 group by antwort 
union select 'Senior+', antworten.id, antwort, count(stimmen.antwort_id) from stimmen JOIN antworten ON antworten.frage_id=stimmen.frage_id AND antworten.id=stimmen.antwort_id where stimmen.frage_id = :id AND stimmen.changesets<2000 and stimmen.changesets>=500 group by antwort
union select 'Senior', antworten.id, antwort, count(stimmen.antwort_id) from stimmen JOIN antworten ON antworten.frage_id=stimmen.frage_id AND antworten.id=stimmen.antwort_id where stimmen.frage_id = :id AND stimmen.changesets<500 and stimmen.changesets>=100 group by antwort
union select 'Junior', antworten.id, antwort, count(stimmen.antwort_id) from stimmen JOIN antworten ON antworten.frage_id=stimmen.frage_id AND antworten.id=stimmen.antwort_id where stimmen.frage_id = :id AND stimmen.changesets<100 and stimmen.changesets>=10 group by antwort
union select 'Nonrecurring', antworten.id, antwort, count(stimmen.antwort_id) from stimmen JOIN antworten ON antworten.frage_id=stimmen.frage_id AND antworten.id=stimmen.antwort_id where stimmen.frage_id = :id AND stimmen.changesets<10 group by antwort
) a ORDER BY id", array(':id'=>$id));
    $stacked = array();
    foreach ($result as $row){
      $stacked[$row->antwort][$row->mappertype] = $row->count;
    }
    return $stacked;
  }

  public function getTimeSeries($id) {
    return $this->_db->select('SELECT year(created) as `year`, month(created) as `month`, day(created) as `day`, count(frage_id) as `count` FROM '.PREFIX.'stimmen WHERE frage_id=:id GROUP BY year(created), month(created), day(created) ORDER BY `year`, `month`, `day`', array(':id'=>$id));
  }

  public function hasAnswered($id, $user){
    $result = $this->_db->select('SELECT frage_id FROM answered WHERE frage_id = :id AND user_id = :user', array(':id'=>$id, ':user'=>$user));
    return $result;
  }

  public function saveAnswer($values) {
    $this->_db->insert(PREFIX.'stimmen', $values);
  }

  public function saveAnswered($values) {
    $this->_db->insert(PREFIX.'answered', $values);
  }

  public function createPoll($poll){
    $this->_db->insert(PREFIX.'fragen', $poll);
    return $this->_db->lastInsertId('id');
  }

  public function createAnswers($answers){
    foreach ($answers as $answer) {
      $this->_db->insert(PREFIX.'antworten', $answer);
    }
  }
}
