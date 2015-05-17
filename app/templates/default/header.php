<!DOCTYPE html>
<html lang="<?=\helpers\session::get('language'); ?>">
<head>

	<title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/core/config.php ?></title>
  
	<!-- Site meta -->
	<meta charset="utf-8">
  <meta name="author" content="Harald Hartmann">
  <meta name="keywords" content="OpenStreetMap, Umfrage, Harald, Hartmann">
  <meta name="description" content="Umfrageplattform für OpenStreetMap von Harald Hartmann">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="alternate" type="application/rss+xml" title="RSS" href="http://osm.haraldhartmann.de/umfrage/rss" />

	<!-- CSS -->
	<?php
		helpers\assets::css(array(
			helpers\url::template_path() . 'css/bootstrap.min.css',
      helpers\url::template_path() . 'css/bootstrap-theme.min.css',
      helpers\url::template_path() . 'css/dataTables.bootstrap.css',
			helpers\url::template_path() . 'css/style.css',
      helpers\url::template_path() . 'css/custom.css'
		))
	?>
  
  <script type="text/javascript">var language="<?=\helpers\session::get('language'); ?>";</script>
  
  <script type="text/javascript">var statsLocalization=<?=\core\language::getJson('stats', \helpers\session::get('language'))?>;</script>
</head>
<body>

    <nav id="top" class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span class="navbar-brand"><a href="<?=DIR?>">Umfrageplattform <small>für OpenStreetMap</small></a> <span class="label label-warning">v1.0</span></span>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <?php if (\helpers\session::get('logged_in')) { ?>
          <p class="navbar-text navbar-left"><?=\helpers\session::get('osm_user_display_name')?> (<a href="http://resultmaps.neis-one.org/oooc?zoom=14<?=!empty(\helpers\session::get('osm_user_lat'))?'&lat='.\helpers\session::get('osm_user_lat').'&lon='.\helpers\session::get('osm_user_lon'):''?>" class="navbar-link">Status <span class="glyphicon glyphicon-new-window"></span></a> <?=\helpers\utils::getMapperType(\helpers\session::get('osm_user_changesets')) ?>)</p>
          <a href="<?=DIR.'logout'?>" class="btn btn-default navbar-btn"><?=core\language::show('btn_logout','main', \helpers\session::get('language')) ?></a>
          <a href="<?=DIR.'poll/create'?>" class="btn btn-default navbar-btn"><?=core\language::show('btn_create','main', \helpers\session::get('language')) ?></a>
        <?php } else { ?>
          <a href="<?=DIR.'oauth/login'?>" class="btn btn-default navbar-btn"><?=core\language::show('login','welcome', \helpers\session::get('language')) ?></a>
        <?php } ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="http://osm.haraldhartmann.de/umfrage/rss/" target="_blank"><img src="<?=helpers\url::template_path() . 'images/rss.png' ?>" width="16px" alt="rss"/></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="flag flag-<?=\helpers\session::get('language')?>"><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php foreach (unserialize(LANGUAGES) as $isocode=>$language) { ?>
              <li><a href="<?=DIR.'language/'.$isocode?>" hreflang="<?=$isocode?>" class="flag flag-<?=$isocode?>"><span class="<?=\helpers\session::get('language')==$isocode?'selected':''?>"><?=$language?></span></a></li>
              <?php } ?>
            </ul>
          </li>
          <li><a href="<?=DIR.'impressum'?>">Impressum</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
	<?php if( isset($data['message']['text']) ) { ?>
	<div class="container">
    <div class="alert alert-<?=$data['message']['type']?>" role="alert">
      <?=htmlspecialchars($data['message']['text']) ?>
    </div>
  </div>
	<?php } ?>
