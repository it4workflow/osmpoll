  <div class="container">
    <div class="row">
      <div class="col-sm-9">
        <div class="panel panel-info">
          <div class="panel-heading"><?=core\language::show('newpoll_headline','poll', \helpers\session::get('language')) ?></div>
          <div class="panel-body">
            <form action="<?=DIR.'poll/create'?>" method="post" name="create-poll" role="form">
              <?php if($data['question']) { ?>
              <input type="hidden" name="id" value="<?=$data['question']->id?>">
              <?php }?>
              <div class="input-group">
                <span class="input-group-addon" id="label-frage"><?=core\language::show('question','poll', \helpers\session::get('language')) ?></span>
                <input type="text" name="frage" class="form-control" value="<?=htmlentities($data['question']->frage)?>" placeholder="<?=core\language::show('question_placeholder','poll', \helpers\session::get('language')) ?>" maxlength="255" aria-describedby="label-frage">
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="label-frage-description"><?=core\language::show('question_description','poll', \helpers\session::get('language')) ?></span>
                <input type="text" name="frage_description" class="form-control" value="<?=htmlentities($data['question']->description)?>" placeholder="<?=core\language::show('question_description_placeholder','poll', \helpers\session::get('language')) ?>" aria-describedby="label-frage-description">
              </div>
              <div class="form-group"></div>
              <?php for ( $i=1; $i<=10; $i++) { ?>
              <div class="input-group">
                <span class="input-group-addon">
                  <?=core\language::show('answer','poll', \helpers\session::get('language')) ?>
                </span>
                <input type="text" name="antwort_<?=$i?>" class="form-control" maxlength="30" value="<?=htmlentities($data['answers'][$i-1]->antwort)?>" placeholder="<?=core\language::show('answer_placeholder','poll', \helpers\session::get('language')) ?>">
                <span class="input-group-addon">
                  <?=core\language::show('answer_description','poll', \helpers\session::get('language')) ?>
                </span>
                <input type="text" name="answer_description_<?=$i?>" class="form-control" maxlength="255" value="<?=htmlentities($data['answers'][$i-1]->description)?>">
              </div>
              <?php } ?>
              <div class="form-group"></div>   
              <div class="form-group">
                <button type="submit" class="btn btn-default" name="save" ><?=core\language::show('btn_create','poll', \helpers\session::get('language')) ?></button>
                <?=core\language::show('btn_create_hint','poll', \helpers\session::get('language')) ?>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default" name="start" ><?=core\language::show('btn_start','poll', \helpers\session::get('language')) ?></button>
                <?=core\language::show('btn_start_hint','poll', \helpers\session::get('language')) ?>
              </div>
            </form>
              <?php if(isset($data['question']) && $data['question']->id > 0) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <?=core\language::show('comment_headline','comment', \helpers\session::get('language')) ?>
                </div>
                <div class="panel-body">
                <?php if(isset($data['comments'])) foreach ($data['comments'] as $comment) { ?>
                  <?=htmlentities($comment->created_by) ?> - <?=date_format(date_create($comment->created),'d. F Y H:i')?></strong>
                  <div class="well well-sm"><?=nl2br(htmlentities($comment->comment)) ?></div>
                  <hr>
                <?php } ?>
                
                <form action="<?=DIR.'poll/'.$data['question']->id.'/comment'?>" method="post" name="comment" role="form">
                  <textarea name="commenttext" class="form-control" rows="6"></textarea>
                  <div class="form-group">
                    <button type="submit" class="btn btn-default" name="submit" ><?=core\language::show('btn_create','comment', \helpers\session::get('language')) ?></button>
                  </div>
                </form>
                </div>
              </div>
              <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="panel panel-warning">
          <div class="panel-heading"><?=core\language::show('hints_headline','poll', \helpers\session::get('language')) ?></div>
          <div class="panel-body">
            <?=core\language::show('hints','poll', \helpers\session::get('language')) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
