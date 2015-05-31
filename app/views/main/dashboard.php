<div class="container">
  
    <div class="alert alert-info">
      <a href="<?=DIR.'hut';?>"><?=core\language::show('how_you_tag','hut', \helpers\session::get('language')) ?></a> <span class="label label-warning">alpha</span>
    </div>
    
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#open"><?=core\language::show('open_polls','main', \helpers\session::get('language')) ?></a></li>
    <?php if( count($data['todo']) > 0 ) { ?>
      <li><a data-toggle="tab" href="#todo"><?=core\language::show('todo_polls','main', \helpers\session::get('language')) ?></a></li>
    <?php } ?>
    <?php if( count($data['draft']) > 0 ) { ?>
      <li><a data-toggle="tab" href="#draft"><?=core\language::show('draft_polls','main', \helpers\session::get('language')) ?></a></li>
    <?php } ?>
    <li><a data-toggle="tab" href="#closed"><?=core\language::show('closed_polls','main', \helpers\session::get('language')) ?></a></li>
  </ul>

  <div class="tab-content">
    <div id="open" class="tab-pane in active">
      <?php if( count($data['open']) > 0 ) { ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <table id="opentable" class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('count','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('until','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('count','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('until','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach ($data['open'] as $poll) {?>
            <tr>
              <td><?=$poll->created_by?></td>
              <td><a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></td>
              <td><?=$poll->count?></td>
              <td><span style="white-space: nowrap;"><?=date_format(date_create($poll->enddate),'Y-m-d')?></span></td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php } ?>
    </div>

    <div id="draft" class="tab-pane">
      <?php if( count($data['draft']) > 0 ) { ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <table id="drafttable" class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach ($data['draft'] as $poll) {?>
            <tr>
              <td><?=$poll->created_by?></td>
              <td><a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php } ?>
    </div>

    <div id="todo" class="tab-pane">
      <?php if( count($data['todo']) > 0 ) { ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <table id="todotable" class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('until','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('until','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach ($data['todo'] as $poll) {?>
            <tr>
              <td><?=$poll->created_by?></td>
              <td><a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></td>
              <td><span style="white-space: nowrap;"><?=date_format(date_create($poll->enddate),'Y-m-d')?></span></td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php } ?>
    </div>

    <div id="closed" class="tab-pane">
    <?php if( count($data['closed']) > 0 ) { ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <table id="closedtable" class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('count','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('until_closed','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th><?=core\language::show('user','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('question','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('count','poll', \helpers\session::get('language')) ?></th>
                <th><?=core\language::show('until_closed','poll', \helpers\session::get('language')) ?></th>
              </tr>
            </tfoot>
          <?php foreach ($data['closed'] as $poll) {?>
            <tr>
              <td><?=$poll->created_by?></td>
              <td><a href="<?=DIR.'poll/'.$poll->id;?>"><?=$poll->frage?></td>
              <td><?=$poll->count?></td>
              <td><span style="white-space: nowrap;"><?=date_format(date_create($poll->enddate),'Y-m-d')?></span></td>
            </tr>
          <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
