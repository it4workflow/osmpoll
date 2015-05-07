<div class="container">
  <h3><a href="<?=DIR.'hut';?>"><?=core\language::show('how_you_tag','hut', \helpers\session::get('language')) ?></a> <span class="label label-warning">alpha</span></h3>
  <hr>
  <div class="alert alert-success"><?=core\language::show('info','hut', \helpers\session::get('language')) ?></div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <a href="https://www.openstreetmap.org/user/<?=$data['hut'][0]->created_by;?>"><?=$data['hut'][0]->created_by;?> <span class="glyphicon glyphicon-new-window"></span></a> <?=core\language::show('wanttoknow','poll', \helpers\session::get('language')) ?><br/>
      <h4><?=htmlentities($data['hut'][0]->title)?></h4>
      <?=\helpers\parsedown::instance()->parse($data['hut'][0]->description) ?><br>
      <?php foreach ($data['images'] as $image) { ?>
      <a href="<?=DIR.'images/'.$image->hut_id.'/'.$image->image; ?>" target="_blank"><img src="<?=DIR.'images/'.$image->hut_id.'/thumbs/'.$image->image; ?>"></a>
      <?php } ?>
    </div>
    <div class="panel-body">
        <?php core\View::render('hut/tags', $data);?>
    </div>
  </div>
</div>