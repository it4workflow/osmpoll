  <div class="container">
    <div class="row">
      <ul>
      <?php foreach ($data['polls'] as $poll) {?>
        <li>
          <?=$poll->created_by?>: <a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></a>
        </li>
      <?php } ?>
      </ul>
    </div>
  </div>
