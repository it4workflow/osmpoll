  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <a href="https://www.openstreetmap.org/user/<?=$data['user_displayname']?>"><?=$data['user_displayname']?> <span class="glyphicon glyphicon-new-window"></span></a> <?=core\language::show('wanttoknow','poll', \helpers\session::get('language')) ?><br/>
        <h4><?=htmlentities($data['question']->frage)?></h4>
        <?=\helpers\parsedown::instance()->parse($data['question']->description) ?>
      </div>
      <div class="panel-body">

        <?php if ($data['closed'] || $data['draftmode'] || $data['answered']) { ?>
          <div class="panel panel-default">
          <?php foreach ($data['answers'] as $answer) { ?>
            <div>
             - <strong><?=$answer->antwort ?></strong> <?=$answer->description ?>
            </div>
          <?php } ?>
          </div>
        <?php } else { ?>
        <form method="post" name="answer" role="form">
        
          <?php foreach ($data['answers'] as $answer) { ?>
          <div class="form-group">
            <div class="radio">
              <label>
                <input type="radio" name="answer" value="<?=$answer->id ?>"> <strong><?=$answer->antwort ?></strong> <?=$answer->description ?>
              </label>
            </div>
          </div>
          <?php } ?>
        
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="anonym" /> <?=core\language::show('chk_anonym','poll', \helpers\session::get('language')) ?>
              </label>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default" name="submit" ><?=core\language::show('btn_answer','poll', \helpers\session::get('language')) ?></button>
            <button type="submit" class="btn btn-default" name="abstain" ><?=core\language::show('btn_abstain','poll', \helpers\session::get('language')) ?></button>
          </div>
        </form>
        <?php } ?>
        
        <?php if($data['closed'] || $data['answered']) { ?>
        <script type="text/javascript">
            var donutdata = [
              <?php foreach ($data['donut'] as $segment) { ?>
                ['<?=$segment->antwort;?>', <?=isset($segment->count)?$segment->count:0 ?>],
              <?php } ?>
            ];

            var stackeddata = { categories: ['Gold', 'Senior+', 'Senior', 'Junior', 'Nonrecurring'],
              series: [
              <?php foreach ($data['stacked'] as $key=>$type) { ?>
                {
                  name: "<?=$key;?>",
                  data: [<?=isset($type['Gold'])?$type['Gold']:0 ?>, <?=isset($type['Senior+'])?$type['Senior+']:0 ?>, <?=isset($type['Senior'])?$type['Senior']:0 ?>, <?=isset($type['Junior'])?$type['Junior']:0 ?>, <?=isset($type['Nonrecurring'])?$type['Nonrecurring']:0 ?>],
                },
              <?php } ?>
              ]
            };

            var timeseries = [
              <?php foreach ($data['timeseries'] as $date) { ?>
                [Date.UTC(<?=$date->year?>, <?=$date->month - 1;?>, <?=$date->day?>), <?=$date->count?>],
              <?php } ?>
            ];
        </script>

        <div role="tabpanel">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a data-toggle="tab" href="#donut-tab"><?=core\language::show('chart_donut','poll', \helpers\session::get('language')) ?></a></li>
            <li><a data-toggle="tab" href="#stacked-tab"><?=core\language::show('chart_stacked','poll', \helpers\session::get('language')) ?></a></li>
            <li><a data-toggle="tab" href="#time-tab"><?=core\language::show('chart_time','poll', \helpers\session::get('language')) ?></a></li>
          </ul>
          <div class="tab-content">
            <div id="donut-tab" class="tab-pane in active" role="tabpanel">
              <div id="donut"> </div>
            </div>
            <div id="stacked-tab" class="tab-pane" role="tabpanel">
              <div id="stacked"> </div>
            </div>
            <div id="time-tab" class="tab-pane" role="tabpanel">
              <div id="time"> </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php //if ($data['public']) { ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <?=core\language::show('comment_headline','comment', \helpers\session::get('language')) ?>
          </div>
          <div class="panel-body">
          <?php foreach ($data['comments'] as $comment) { ?>
            <?=htmlentities($comment->created_by) ?> - <?php $date = new DateTime($comment->created); echo $date->format(DateTime::RFC2822); ?></strong>
            <div class="well well-sm"><?=\helpers\parsedown::instance()->parse($comment->comment) ?></div>
            <hr>
          <?php } ?>
          
          <form action="<?=DIR.'poll/'.$data['question']->id.'/comment'?>" method="post" name="comment" role="form">
            <textarea name="commenttext" class="form-control" rows="6" placeholder="markdown support"></textarea>
            <div class="form-group">
              <button type="submit" class="btn btn-default" name="submit" ><?=core\language::show('btn_create','comment', \helpers\session::get('language')) ?></button>
            </div>
          </form>

          </div>
        </div>
        <?php //} ?>
      </div>
    </div>
  </div>
