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
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="description"><?=core\language::show('question_description','poll', \helpers\session::get('language')) ?></label>
            <textarea id="maincomment" name="description" class="form-control" rows="6" placeholder="markdown support"></textarea>
          </div>
          <button id="btnPreview" type="preview" class="btn btn-default" name="preview" ><?=core\language::show('btn_preview','comment', \helpers\session::get('language')) ?></button>
          <button type="submit" class="btn btn-default"><?=core\language::show('btn_create','hut', \helpers\session::get('language')) ?></button>
        </div>
        <div class="col-sm-6">
          <blockquote id="preview"></blockquote>
        </div>
      </div>
  </form>
  <?php } ?>
</div>