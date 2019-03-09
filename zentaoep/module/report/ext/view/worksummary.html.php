<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<div id='mainContent' class='main-row'>
  <div class='side-col col-lg'>
    <?php include '../../view/blockreportlist.html.php';?>
  </div>
  <div class='main-col'>
    <div class='cell'>
      <div class='with-padding'>
        <div class="table-row" id='conditions'>
          <form method='post'>
            <div class='col-sm-3'>
              <div class='input-group input-group-sm'>
                <span class='input-group-addon'><?php echo $lang->report->dept;?></span>
                <?php echo html::select('dept', $depts, $dept, "class='form-control chosen' onchange='changeParams(this)'");?>
              </div>
            </div>
            <div class='col-sm-5'>
              <div class='input-group input-group-sm'>
                <span class='input-group-addon'><?php echo $lang->report->taskFinishedDate;?></span>
                <div class='datepicker-wrapper datepicker-date'><?php echo html::input('begin', $begin, "class='form-control form-date' onchange='changeParams(this)'");?></div>
                <span class='input-group-addon'><?php echo $lang->report->to;?></span>
                <div class='datepicker-wrapper datepicker-date'><?php echo html::input('end', $end, "class='form-control form-date' onchange='changeParams(this)'");?></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php if(empty($userTasks)):?>
    <div class="cell">
      <div class="table-empty-tip">
        <p><span class="text-muted"><?php echo $lang->error->noData;?></span></p>
      </div>
    </div>
    <?php else:?>
    <div class='cell'>
      <div class='panel'>
        <div class="panel-heading">
          <div class="panel-title"><?php echo $title;?></div>
          <nav class="panel-actions btn-toolbar"></nav>
        </div>
        <div data-ride='table'>
          <table class='table table-condensed table-striped table-bordered table-fixed' id="worksummary">
            <thead>
              <tr class='colhead'>
                <th class="w-70px"><?php echo $lang->task->finishedByAB;?></th>
                <th><?php echo $lang->task->project;?></th>
                <th class="w-50px"><?php echo $lang->task->id;?></th>
                <th><?php echo $lang->task->name;?></th>
                <th class="w-50px"><?php echo $lang->task->pri;?></th>
                <th class="w-80px"><?php echo $lang->task->estStarted;?></th>
                <th class="w-80px"><?php echo $lang->task->realStarted;?></th>
                <th class="w-80px"><?php echo $lang->task->deadline;?></th>
                <th class="w-80px"><?php echo $lang->task->finishedDate;?></th>
                <th class="w-60px"><?php echo $lang->report->delay . '(' . $lang->report->day . ')';?></th>
                <th class="w-60px"><?php echo $lang->task->estimate;?></th>
                <th class="w-80px"><?php echo $lang->report->taskConsumed;?></th>
                <th class="w-60px"><?php echo $lang->report->taskTotal;?></th>
                <th class="w-80px"><?php echo $lang->report->projectConsumed;?></th>
                <th class="w-80px"><?php echo $lang->report->userConsumed;?></th>
              </tr>
            </thead>
            <tbody>
              <?php $color = false;?>
              <?php $i     = 0;?>
              <?php foreach($userTasks as $user => $projectTaskGroup):?>
              <?php if(!isset($users[$user])) continue;?>
              <?php
              $taskTotal       = $totalConsumed = 0;
              $projectConsumed = array();
              foreach($projectTaskGroup as $tasks)
              {
                  $taskTotal += count($tasks); 
                  foreach($tasks as $task)
                  {
                      if(!isset($projectConsumed[$task->project])) $projectConsumed[$task->project] = 0;
                      $projectConsumed[$task->project] += $task->consumed;
                      $totalConsumed += $task->consumed;
                  }
              }
              ?>
              <tr class="text-center">
                <td class="w-user" rowspan="<?php echo $taskTotal;?>"><?php echo zget($users, $user);?></td>
                <?php $j = 0;?>
                <?php foreach($projectTaskGroup as $projectID => $tasks):?>
                <?php $projectTaskTotal = count($tasks);?>
                <?php if($j != 0) echo "<tr class='text-center'>"?>
                <?php $projectName = zget($projects, $projectID, '');?>
                <td class='text-left' rowspan="<?php echo $projectTaskTotal;?>" title='<?php echo $projectName?>'><?php echo $projectName;?></td>
                <?php $k = 0;?>
                <?php foreach($tasks as $task):?>
                <?php if($k != 0) echo "<tr class='text-center'>"?>
                <td><?php echo $task->id;?></td>
                <td class="text-left" title="<?php echo $task->name;?>"><?php echo $task->name;?></td>
                <td><span class='<?php echo 'pri' . $task->pri?>'><?php echo $task->pri;?></span></td>
                <td><?php echo $task->estStarted;?></td>
                <td><?php echo $task->realStarted;?></td>
                <td><?php echo $task->deadline;?></td>
                <td><?php echo substr($task->finishedDate, 0, 10);?></td>
                <td>
                <?php if($task->deadline != '0000-00-00')
                {
                    $finishedDate = strtotime(substr($task->finishedDate, 0, 10));
                    $deadline     = strtotime($task->deadline);
                    $days         = round(($finishedDate - $deadline) / 3600 / 24);
                    if($days > 0) echo $days;
                } 
                ?>
                </td>
                <td><?php echo $task->estimate;?></td>
                <td><?php echo $task->consumed;?></td>
                <?php if($k == 0):?>
                <td rowspan="<?php echo $projectTaskTotal;?>"><?php echo $projectTaskTotal;?></td>
                <td rowspan="<?php echo $projectTaskTotal;?>"><?php echo zget($projectConsumed, $projectID, '');?></td>
                <?php endif;?>
                <?php if($j == 0):?>
                <td rowspan="<?php echo $taskTotal;?>"><?php echo $totalConsumed;?></td>
                <?php endif;?>
              </tr>
              <?php $i++; $j++; $k++;?>
              <?php endforeach;?>
              <?php endforeach;?>
              <?php endforeach;?>
            </tbody>
          </table> 
        </div>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>
<?php include '../../../common/view/footer.html.php';?>
