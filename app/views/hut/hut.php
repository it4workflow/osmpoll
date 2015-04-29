<div class="container">
  <h3><a href="<?=DIR.'hut';?>">Wie taggt man ...</a></h3>
  <hr>
  <div class="panel panel-default">
    <div class="panel-heading">
      <a href="https://www.openstreetmap.org/user/<?=$data['hut'][0]->created_by;?>"><?=$data['hut'][0]->created_by;?> <span class="glyphicon glyphicon-new-window"></span></a> <?=core\language::show('wanttoknow','poll', \helpers\session::get('language')) ?><br/>
      <h4><?=htmlentities($data['hut'][0]->title)?></h4>
      <?=htmlentities($data['hut'][0]->description)?>
    </div>
    <div class="panel-body">
        <?php core\View::render('hut/tags', $data);?>
    </div>
  </div>
</div>