  <div class="container">
    <div class="alert alert-warning" role="alert">
      <strong><?=core\language::show('login_required','welcome', \helpers\session::get('language')) ?></strong>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <h3><?=core\language::show('how_title','welcome', \helpers\session::get('language')) ?></h3>
        <?=core\language::show('how_description','welcome', \helpers\session::get('language')) ?>
        <form action="<?=DIR.'oauth/login'?>" method="post" name="oauth-login" class="form-horizontal" role="form">
          <button type="submit" class="btn btn-default" name="login" ><?=core\language::show('login','welcome', \helpers\session::get('language')) ?></button>
        </form>   
      </div>
      <div class="col-sm-4">
        <h3><?=core\language::show('why_title','welcome', \helpers\session::get('language')) ?></h3>
        <?=core\language::show('why_description','welcome', \helpers\session::get('language')) ?>
      </div>
      <div class="col-sm-4">
        <h3><?=core\language::show('which_title','welcome', \helpers\session::get('language')) ?></h3>
        <?=core\language::show('which_description','welcome', \helpers\session::get('language')) ?>
      </div>
    </div>
  </div>
