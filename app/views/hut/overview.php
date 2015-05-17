<div class="container">
    <h3><a href="<?=DIR.'hut';?>">Wie taggt man ...</a> <span class="label label-warning">alpha</span></h3>
  <hr>
  <?php foreach($data['overview'] as $hut) { ?>
  <div class="row">
    <div class="col-sm-8">
      <a href="<?=DIR.'hut/'.$hut->id; ?>"><?=$hut->title; ?></a>  
    </div>
    <div class="col-sm-2">
      <?=$hut->created_by; ?>
    </div>
    <div class="col-sm-2">
      <?=$hut->created; ?>
    </div>
  </div>
  <?php } ?>
  <?php if (\helpers\session::get('logged_in')) { ?>
  <hr>
  <form action="<?=DIR.'hut/create'?>" method="post" name="create-hut" role="form">
      <div class=form-group">
        <label for="title"><?=core\language::show('title','hut', \helpers\session::get('language')) ?></label>
        <input type="text" name="title" class="form-control" maxlength="255">
      </div>
      <div class="form-group">
        <label for="description"><?=core\language::show('question_description','poll', \helpers\session::get('language')) ?></label>
        <textarea id="description" name="description" class="form-control" rows="6" placeholder="markdown support"></textarea>
      </div>
      <button type="submit" class="btn btn-default"><?=core\language::show('btn_create','hut', \helpers\session::get('language')) ?></button>
  </form>
  <?php } ?>
</div>