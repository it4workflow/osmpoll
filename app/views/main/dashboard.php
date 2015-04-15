  <div class="container">
    <?php if( count($data['todo']) > 0 ) { ?>
    <div class="row">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title"><?=core\language::show('todo_polls','main', \helpers\session::get('language')) ?></h3>
        </div>
        <div class="panel-body">
          <ul>
          <?php foreach ($data['todo'] as $poll) {?>
            <li>
              <?=$poll->created_by?>: <a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></a>
            </li>
          <?php } ?>
          </ul>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if( count($data['open']) > 0 ) { ?>
    <div class="row">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"><?=core\language::show('open_polls','main', \helpers\session::get('language')) ?></h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-condensed">
            <thead>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('count','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('until','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </thead>
          <?php foreach ($data['open'] as $poll) {?>
            <tr>
              <td><?=$poll->created_by?></td>
              <td><a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></td>
              <td><?=$poll->count?></td>
              <td><?=date_format(date_create($poll->enddate),'d.m.Y')?></td>
            </tr>
          <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <?php } ?>
   <?php if( count($data['closed']) > 0 ) { ?>
    <div class="row">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"><?=core\language::show('closed_polls','main', \helpers\session::get('language')) ?></h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-condensed">
            <thead>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('count','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('until_closed','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </thead>
          <?php foreach ($data['closed'] as $poll) {?>
            <tr>
              <td><?=$poll->created_by?></td>
              <td><a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></td>
              <td><?=$poll->count?></td>
              <td><?=date_format(date_create($poll->enddate),'d.m.Y')?></td>
            </tr>
          <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
