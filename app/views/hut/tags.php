<?php 
foreach($data['tags'] as $tag) { ?>
<div class="row">
    <div class="col-sm-1"><span class="<?=$data['votes'][$tag->id]==1?'green':''?>">up</span></div>
    <div class="col-sm-1"><?=$tag->votes;?></div>
    <div class="col-sm-1"><span class="<?=$data['votes'][$tag->id]==-11?'red':''?>">down</span></div>
    <div class="col-sm-2"><pre><?=$tag->key;?> </pre></div>
    <div class="col-sm-1">=</div>
    <div class="col-sm-2"><pre><?=$tag->value;?></pre></div>
</div>
<?php } ?>
