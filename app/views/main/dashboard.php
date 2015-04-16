<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#open"><?=core\language::show('open_polls','main', \helpers\session::get('language')) ?></a></li>
    <li><a data-toggle="tab" href="#closed"><?=core\language::show('closed_polls','main', \helpers\session::get('language')) ?></a></li>
  </ul>

  <div class="tab-content">
    <div id="open" class="tab-pane in active">
      <?php if( count($data['open']) > 0 ) { ?>
      <div class="panel panel-default">
        <table class="table table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th> </th>
              <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
              <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
              <th><?=core\language::show('count','poll', \helpers\session::get('language')) ?></th>
              <th><?=core\language::show('until','poll', \helpers\session::get('language')) ?></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data['open'] as $poll) {?>
          <tr>
            <td><span class="glyphicon glyphicon-<?=$poll->answered?'check':'unchecked';?>"></span></td>
            <td><?=$poll->created_by?></td>
            <td><a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></td>
            <td><?=$poll->count?></td>
            <td><?=date_format(date_create($poll->enddate),'d.m.Y')?></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <?php } ?>
    </div>

    <div id="closed" class="tab-pane">
    <?php if( count($data['closed']) > 0 ) { ?>
      <div class="panel panel-default">
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
    <?php } ?>
  </div>
</div>