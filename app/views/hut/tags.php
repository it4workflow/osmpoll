<div class="row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-2" style="font-size: 1.4em;">
    <a href="#" data-toggle-comments="tagcomments" data-id="<?=$tag->id?>">
      <span class="glyphicon glyphicon-comment" data-toggle="tooltip" data-placement="top" title="<?=core\language::show('show_all_comments','hut', \helpers\session::get('language')) ?>"></span>
    </a>
  </div>  
</div>
<?php 
  foreach($data['tags'] as $tag) { ?>
  <div class="tagrow">
    <div class="row tag">
      <div class="col-sm-2">
        <div class="">
          <?php if (\helpers\session::get('logged_in')) { ?>  
          <a class="label <?=$data['uservotes'][$tag->id]==1?'label-success':''?>" href="<?=DIR.'hut/'.$tag->hut_id.($data['uservotes'][$tag->id]==1?'/delete/':'/vote/up/').$tag->id?>" data-toggle="tooltip" data-placement="left" title="<?=$data['uservotes'][$tag->id]==1?core\language::show('cancel_vote','hut', \helpers\session::get('language')) :core\language::show('vote','hut', \helpers\session::get('language'))?>" ><span class="glyphicon glyphicon-chevron-up glyphicon-thumbs-up <?=$data['uservotes'][$tag->id]==1?'':'text-muted'?>"></span></a> 
          <?php } ?>
          <span class="label <?php if ($tag->votes>0) echo 'label-success'; if ($tag->votes<0) echo 'label-danger'; if ($tag->votes==0) echo 'label-default';?>" data-toggle="tooltip" data-placement="top" title="<?=$tag->up; ?> | <?=$tag->down; ?>"><?=$tag->votes;?></span>            
          <?php if (\helpers\session::get('logged_in')) { ?>
          <a class="label <?=$data['uservotes'][$tag->id]==-1?'label-danger':''?>" href="<?=DIR.'hut/'.$tag->hut_id.($data['uservotes'][$tag->id]==-1?'/delete/':'/vote/down/').$tag->id?>" data-toggle="tooltip" data-placement="right" title="<?=$data['uservotes'][$tag->id]==-1?core\language::show('cancel_vote','hut', \helpers\session::get('language')):core\language::show('vote','hut', \helpers\session::get('language'))?>" >
            <span class="glyphicon glyphicon-chevron-down glyphicon-thumbs-down <?=$data['uservotes'][$tag->id]==-1?'':'text-muted'?>"></span>
          </a> 
          <?php } ?>
        </div>
      </div>
      <div class="col-sm-2">
        <span class="glyphicon glyphicon-user" title="<?=$tag->created_by?>" data-toggle="tooltip" data-placement="left"></span>
        <span class="glyphicon glyphicon-time" title="<?=$tag->created?>" data-toggle="tooltip" data-placement="top"></span>
        <a href="#" data-toggle="tagcomment" data-toggle="tooltip" data-placement="right" title="<?=core\language::show('show_comments','hut', \helpers\session::get('language')) ?>" data-id="<?=$tag->id?>"><?=sizeof($tag->comments)?>x <span class="glyphicon glyphicon-comment"></span></a>
      </div>
      <div class="col-sm-8">
        <a href="https://wiki.openstreetmap.org/wiki/Key:<?=$tag->tagkey;?>" data-toggle="tooltip" data-placement="left" title="<?=core\language::show('goto_wiki_key','hut', \helpers\session::get('language')) ?>" target="_blank"><span class="label label-default"><?=$tag->tagkey;?></span></a> = 
        <a href="https://wiki.openstreetmap.org/wiki/Tag:<?=$tag->tagkey;?>%3D<?=$tag->tagvalue;?>" data-toggle="tooltip" data-placement="right" title="<?=core\language::show('goto_wiki_tag','hut', \helpers\session::get('language')) ?>" target="_blank"><span class="label label-default"><?=$tag->tagvalue;?></span></a>
      </div>
    </div>
<div id="tagcomments_<?=$tag->id?>" data-type="tagcomment" style="display: none;">
      <?php foreach ($tag->comments as $comment) { ?>
      <div class="row">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-8">
          <blockquote><?=\helpers\parsedown::instance()->parse($comment->comment) ?><footer><?=htmlentities($comment->created_by);?>, <?=htmlentities($comment->created);?></footer></blockquote>  
        </div>
      </div>
      <?php } ?>
      <?php if (\helpers\session::get('logged_in')) { ?>
      <div class="row">
        <form action="<?=DIR.'hut/'.$data['hut'][0]->id.'/tag/'.$tag->id.'/add'; ?>" method="post" name="huttag" role="form">
          <div class="col-sm-4 text-right"><?=core\language::show('new_subtag','hut', \helpers\session::get('language')) ?></div>
          <div class="col-sm-2">
            <input class="form-control" type="text" name="tagkey" placeholder="key"/>
          </div>
          <div class="col-sm-1">
            <div class="text-center">=</div>
          </div>
          <div class="col-sm-2">
            <input class="form-control" type="text" name="tagvalue" placeholder="value" />
          </div>
          <button type="submit" class="btn btn-default" name="add" ><?=core\language::show('btn_create','hut', \helpers\session::get('language')) ?></button>
        </form>
      </div>
      <?php } ?>
      <?php if (\helpers\session::get('logged_in')) { ?>
      <div class="row">
        <form action="<?=DIR.'hut/'.$tag->hut_id.'/tag/'.$tag->id.'/comment/add'; ?>" method="post" name="comment" role="form">
          <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-8">
              <textarea name="tagcomment" class="form-control" rows="1"></textarea>
            </div>
            <div class="col-sm-2">
            <button type="submit" class="btn btn-default" name="add" ><?=core\language::show('btn_create','comment', \helpers\session::get('language')) ?></button>
            </div>
        </form>
      </div>
      <?php } ?>
    </div> 
    <?php foreach ($tag->subtags as $subtag) { ?>
      <div class="row subtag">
        <div class="col-sm-2">
          <div class="">
            <?php if (\helpers\session::get('logged_in')) { ?>
            <a class="label <?=$data['uservotes'][$subtag->id]==1?'label-success':''?>" href="<?=DIR.'hut/'.$subtag->hut_id.($data['uservotes'][$subtag->id]==1?'/delete/':'/vote/up/').$subtag->id?>" data-toggle="tooltip" data-placement="left" title="<?=$data['uservotes'][$subtag->id]==1?core\language::show('cancel_vote','hut', \helpers\session::get('language')) :core\language::show('vote','hut', \helpers\session::get('language'))?>" ><span class="glyphicon glyphicon-chevron-up glyphicon-thumbs-up <?=$data['uservotes'][$subtag->id]==1?'':'text-muted'?>"></span></a>
            <?php } ?>
            <span class="label <?php if ($subtag->votes>0) echo 'label-success'; if ($subtag->votes<0) echo 'label-danger'; if ($subtag->votes==0) echo 'label-default';?>" data-toggle="tooltip" data-placement="top" title="<?=$subtag->up; ?> | <?=$subtag->down; ?>"><?=$subtag->votes;?></span>            
            <?php if (\helpers\session::get('logged_in')) { ?>
            <a class="label <?=$data['uservotes'][$subtag->id]==-1?'label-danger':''?>" href="<?=DIR.'hut/'.$subtag->hut_id.($data['uservotes'][$subtag->id]==-1?'/delete/':'/vote/down/').$subtag->id?>" data-toggle="tooltip" data-placement="right" title="<?=$data['uservotes'][$subtag->id]==-1?core\language::show('cancel_vote','hut', \helpers\session::get('language')):core\language::show('vote','hut', \helpers\session::get('language'))?>" ><span class="glyphicon glyphicon-chevron-down glyphicon-thumbs-down <?=$data['uservotes'][$subtag->id]==-1?'':'text-muted'?>"></span></a>
            <?php } ?>
          </div>
        </div>
        <div class="col-sm-2">
          <span class="glyphicon glyphicon-user" title="<?=$subtag->created_by?>" data-toggle="tooltip" data-placement="left"></span>
          <span class="glyphicon glyphicon-time" title="<?=$subtag->created?>" data-toggle="tooltip" data-placement="top"></span>
          <a href="#" data-toggle="tagcomment" data-toggle="tooltip" data-placement="right" title="<?=core\language::show('show_comments','hut', \helpers\session::get('language')) ?>" data-id="<?=$subtag->id?>"><?=sizeof($subtag->comments)?>x <span class="glyphicon glyphicon-comment"></span></a>
        </div>
        <div class="col-sm-8">
          <a href="https://wiki.openstreetmap.org/wiki/Key:<?=$subtag->tagkey;?>" data-toggle="tooltip" data-placement="left" title="<?=core\language::show('goto_wiki_key','hut', \helpers\session::get('language')) ?>" target="_blank"><span class="label label-default"><?=$subtag->tagkey;?></span></a> = 
          <a href="https://wiki.openstreetmap.org/wiki/Tag:<?=$subtag->tagkey;?>%3D<?=$subtag->tagvalue;?>" data-toggle="tooltip" data-placement="right" title="<?=core\language::show('goto_wiki_tag','hut', \helpers\session::get('language')) ?>" target="_blank"><span class="label label-default"><?=$subtag->tagvalue;?></span></a>
        </div>
      </div>
      <div id="tagcomments_<?=$subtag->id?>" data-type="tagcomment" style="display: none;">
        <?php foreach ($subtag->comments as $comment) { ?>
        <div class="row">
          <div class="col-sm-2">&nbsp;</div>
          <div class="col-sm-8">
            <blockquote><?=\helpers\parsedown::instance()->parse($comment->comment) ?><footer><?=htmlentities($comment->created_by);?>, <?=htmlentities($comment->created);?></footer></blockquote>  
          </div>
        </div>
        <?php } ?>
        <?php if (\helpers\session::get('logged_in')) { ?>
        <div class="row">
          <form action="<?=DIR.'hut/'.$tag->hut_id.'/tag/'.$subtag->id.'/comment/add'; ?>" method="post" name="comment" role="form">
            <div class="col-sm-2">&nbsp;</div>
              <div class="col-sm-8">
                <textarea name="tagcomment" class="form-control" rows="1"></textarea>
              </div>
              <div class="col-sm-2">
              <button type="submit" class="btn btn-default" name="add" ><?=core\language::show('btn_create','comment', \helpers\session::get('language')) ?></button>
              </div>
          </form>
        </div>
        <?php } ?>
      </div>        
    <?php } ?>
  </div>
  <?php } ?>

<?php if (\helpers\session::get('logged_in')) { ?>
<hr>
<div class="row">
  <form action="<?=DIR.'hut/'.$data['hut'][0]->id.'/tag/add'; ?>" method="post" name="huttag" role="form">
    <div class="col-sm-4 text-right"><?=core\language::show('new_tag','hut', \helpers\session::get('language')) ?></div>
    <div class="col-sm-2">
      <input class="form-control" type="text" name="tagkey" placeholder="key"/>
    </div>
    <div class="col-sm-1">
      <div class="text-center">=</div>
    </div>
    <div class="col-sm-2">
      <input class="form-control" type="text" name="tagvalue" placeholder="value" />
    </div>
    <button type="submit" class="btn btn-default" name="add" ><?=core\language::show('btn_create','hut', \helpers\session::get('language')) ?></button>
  </form>
</div>
<?php } ?>
