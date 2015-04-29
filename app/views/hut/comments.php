<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <?=core\language::show('comment_headline','comment', \helpers\session::get('language')) ?>
    </div>
    <div class="panel-body">
    <?php foreach ($data['comments'] as $comment) { ?>
      <?=htmlentities($comment->created_by) ?> - <?=date_format(date_create($comment->created),'d. F Y H:i')?></strong>
      <div class="well well-sm"><?=nl2br(htmlentities($comment->comment)) ?></div>
      <hr>
    <?php } ?>

    <form action="<?=DIR.'hut/comment/'.$data['hut'][0]->id; ?>" method="post" name="comment" role="form">
      <textarea name="comment" class="form-control" rows="6"></textarea>
      <div class="form-group">
        <button type="submit" class="btn btn-default" name="add" ><?=core\language::show('btn_create','comment', \helpers\session::get('language')) ?></button>
      </div>
    </form>

    </div>
  </div>
</div>  