<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <?=core\language::show('comment_headline','comment', \helpers\session::get('language')) ?>
    </div>
    <div class="panel-body">
    <?php foreach ($data['comments'] as $comment) { ?>
      <?=htmlentities($comment->created_by) ?> - <?=date_format(date_create($comment->created),'d. F Y H:i')?></strong>
      <div class="well well-sm"><?=\helpers\parsedown::instance()->parse($comment->comment) ?></div>
      <hr>
    <?php } ?>

    <?php if (\helpers\session::get('logged_in')) { ?>  
    <form action="<?=DIR.'hut/comment/'.$data['hut'][0]->id; ?>" method="post" name="comment" role="form">
      <div class="row">
        <div class="col-sm-6">
          <textarea id="maincomment" name="comment" class="form-control" rows="6" placeholder="markdown support"></textarea>
          <div class="form-group">
            <button id="btnPreview" type="preview" class="btn btn-default" name="preview" ><?=core\language::show('btn_preview','comment', \helpers\session::get('language')) ?></button>
            <button type="submit" class="btn btn-default" name="add" ><?=core\language::show('btn_create','comment', \helpers\session::get('language')) ?></button>
          </div>
        </div>
        <div class="col-sm-6">
          <blockquote id="preview"></blockquote>
        </div>
      </div>
    </form>
    <?php } ?>
    </div>
  </div>
</div>  