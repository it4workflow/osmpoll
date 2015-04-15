  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <div class="panel panel-info">
          <div class="panel-heading"><?=core\language::show('newpoll_headline','poll', \helpers\session::get('language')) ?></div>
          <div class="panel-body">
            <form action="" method="post" name="create-poll" role="form">
              <div class="input-group">
                <span class="input-group-addon" id="label-frage"><?=core\language::show('question','poll', \helpers\session::get('language')) ?></span>
                <input type="text" name="frage" class="form-control" placeholder="<?=core\language::show('question_placeholder','poll', \helpers\session::get('language')) ?>" maxlength="255" aria-describedby="label-frage">
              </div>
              <?php for ( $i=1; $i<=10; $i++) { ?>
              <div class="input-group">
                <span class="input-group-addon">
                  <?=core\language::show('answer','poll', \helpers\session::get('language')) ?>
                </span>
                <input type="text" name="antwort_<?=$i?>" class="form-control" maxlength="30" placeholder="<?=core\language::show('answer_placeholder','poll', \helpers\session::get('language')) ?>">
                <span class="input-group-addon">
                  <?=core\language::show('answer_description','poll', \helpers\session::get('language')) ?>
                </span>
                <input type="text" name="answer_description_<?=$i?>" class="form-control" maxlength="255">
              </div>
              <?php } ?>     
              <div class="form-group">
                <button type="submit" class="btn btn-default" name="submit" ><?=core\language::show('btn_create','poll', \helpers\session::get('language')) ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-warning">
          <div class="panel-heading"><?=core\language::show('hints_headline','poll', \helpers\session::get('language')) ?></div>
          <div class="panel-body">
            <?=core\language::show('hints','poll', \helpers\session::get('language')) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
