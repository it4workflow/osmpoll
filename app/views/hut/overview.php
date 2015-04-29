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
</div>