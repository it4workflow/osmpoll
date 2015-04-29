  <?php foreach($data['comments'] as $comment) { ?>
  <hr>
  <div class="row">
    <div class="col-sm-8">
      <?=$comment->comment; ?>
    </div>
    <div class="col-sm-2">
      <?=$comment->created_by; ?>
    </div>
    <div class="col-sm-2">
      <?=$comment->created; ?>
    </div>
  </div>
  <?php } ?>
<hr>
<form action="<?=DIR.'hut/comment/'.$data['hut'][0]->id; ?>" method="post">
    <textarea rows="5" cols="80" name="comment"></textarea>
    <br>
    <input type="submit" name="add" value="Speichern" />
</form>
</div>