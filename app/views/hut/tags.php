
<form action="<?=DIR.'hut/'.$data['hut'][0]->id.'/tag/add'; ?>" method="post" name="huttag" role="form">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-3">
            <input class="form-control" type="text" name="tagkey" placeholder="key"/>
        </div>
        <div class="col-sm-1">
            <div class="text-center">=</div>
        </div>
        <div class="col-sm-3">
            <input class="form-control" type="text" name="tagvalue" placeholder="value" />
        </div>
        <button type="submit" class="btn btn-default" name="add" ><?=core\language::show('btn_create','comment', \helpers\session::get('language')) ?></button>
  </form>
<hr>
  <?php 
  foreach($data['tags'] as $tag) { ?>
    <div class="row" style="font-size: 1.5em; margin-bottom: 0.25em;">
      <div class="col-sm-2">
          <div class="">
            <a href="<?=DIR.'hut/'.$tag->hut_id.($data['uservotes'][$tag->id]==1?'/delete/':'/vote/up/').$tag->id?>" data-toggle="tooltip" data-placement="left" title="<?=$data['uservotes'][$tag->id]==1?'cancel vote':'vote'?>" ><span class="glyphicon glyphicon-chevron-up glyphicon-thumbs-up <?=$data['uservotes'][$tag->id]==1?'text-success':'text-muted'?>"></span></a>
            <span class="label <?php if ($tag->votes>0) echo 'label-success'; if ($tag->votes<0) echo 'label-danger'; if ($tag->votes==0) echo 'label-default';?>" data-toggle="tooltip" data-placement="top" title="<?=$tag->up; ?> / <?=$tag->down; ?>"><?=$tag->votes;?></span>            <a href="<?=DIR.'hut/'.$tag->hut_id.($data['uservotes'][$tag->id]==-1?'/delete/':'/vote/down/').$tag->id?>" data-toggle="tooltip" data-placement="right" title="<?=$data['uservotes'][$tag->id]==-1?'cancel vote':'vote'?>" ><span class="glyphicon glyphicon-chevron-down glyphicon-thumbs-down <?=$data['uservotes'][$tag->id]==-1?'text-danger':'text-muted'?>"></span></a>
          </div>
      </div>
      <div class="col-sm-8">
          <a href="https://wiki.openstreetmap.org/wiki/Key:<?=$tag->tagkey;?>" data-toggle="tooltip" data-placement="left" title="goto wiki (key)" target="_blank"><span class="label label-default"><?=$tag->tagkey;?></span></a> = 
          <a href="https://wiki.openstreetmap.org/wiki/Tag:<?=$tag->tagkey;?>%3D<?=$tag->tagvalue;?>" data-toggle="tooltip" data-placement="right" title="goto wiki (tag)" target="_blank"><span class="label label-default"><?=$tag->tagvalue;?></span></a>
      </div>
      <div class="col-sm-2">
          <span class="glyphicon glyphicon-user" title="<?=$tag->created_by?>" data-toggle="tooltip" data-placement="top"></span>
          <span class="glyphicon glyphicon-time" title="<?=$tag->created?>" data-toggle="tooltip" data-placement="top"></span>
          <a href="#" data-toggle="tagcomment" data-id="<?=$tag->id?>"><?=sizeof($tag->comments)?>x <span class="glyphicon glyphicon-comment"></span></a>
      </div>
    </div> 
    <div id="tagcomments_<?=$tag->id?>" style="display: none;">
    <?php foreach ($tag->comments as $comment) { ?>
    <div class="row">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-6">
            <blockquote><?=nl2br(htmlentities($comment->comment));?><footer><?=htmlentities($comment->created_by);?>, <?=htmlentities($comment->created);?></footer></blockquote>  
        </div>
    </div>
    <?php } ?>
    <div class="row">
              <form action="<?=DIR.'hut/'.$tag->hut_id.'/tag/'.$tag->id.'/comment/add'; ?>" method="post" name="comment" role="form">
        <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-6">
                <textarea name="tagcomment" class="form-control" rows="1"></textarea>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-default" name="add" ><?=core\language::show('btn_create','comment', \helpers\session::get('language')) ?></button>
              
            </form>
        </div>
    </div>
    </div>        
  <?php } ?>
    
    
    