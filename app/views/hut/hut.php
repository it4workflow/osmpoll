<div class="container">
<div class="row">
    <div class="col-sm-8">
      <h2><?=$data['hut'][0]->title; ?></h2>
      <?=$data['hut'][0]->description; ?>
    </div>
    <div class="col-sm-2">
      <?=$data['hut'][0]->created_by; ?>
    </div>
    <div class="col-sm-2">
      <?=$data['hut'][0]->created; ?>
    </div>    
  </div>
