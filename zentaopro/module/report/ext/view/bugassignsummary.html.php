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
            <div class='input-group input-group-sm '>
              <span class='input-group-addon'><?php echo $lang->report->dept;?></span>
              <?php echo html::select('dept', $depts, $dept, "class='form-control chosen' onchange='changeParams(this)'");?>
            </div>
          </div>
          <div class='col-sm-5'>
              <div class='input-group input-group-sm'>
                <span class='input-group-addon'><?php echo $lang->report->bugAssignedDate;?></span>
                <div class='datepicker-wrapper datepicker-date'><?php echo html::input('begin', $begin, "class='form-control form-date' onchange='changeParams(this)'");?></div>
                <span class='input-group-addon'><?php echo $lang->report->to;?></span>
                <div class='datepicker-wrapper datepicker-date'><?php echo html::input('end', $end, "class='form-control form-date' onchange='changeParams(this)'");?></div>
              </div>
           </div>
         </form>
        </div>
      </div>
    </div>
    <?php if(empty($userBugs)):?>
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
          <table class='table table-condensed table-striped table-bordered table-fixed' id="bugsummary">
            <thead>
              <tr class='colhead'>
              <th class="w-80px"><?php echo $lang->bug->assignedTo;?></th>
              <th class="w-id"><?php echo $lang->bug->id;?></th>
              <th title="<?php echo $lang->bug->title;?>"><?php echo $lang->bug->title;?></th>
              <th class="w-50px"><?php echo $lang->bug->pri;?></th>
              <th class="w-80px"><?php echo $lang->bug->severity;?></th>
              <th class="w-80px"><?php echo $lang->bug->openedBy;?></th>
              <th class="w-80px"><?php echo $lang->bug->openedDate;?></th>
              <th class="w-80px"><?php echo $lang->bug->assignedDate;?></th>
              <th class="w-70px"><?php echo $lang->bug->status;?></th>
            </tr>
            </thead>
            <tbody>
              <?php foreach($userBugs as $user => $bugs):?>
              <?php if(!isset($users[$user])) continue;?>
              <tr class="text-center">
                <td class="w-user text-top" rowspan="<?php echo count($bugs);?>"><?php echo zget($users, $user);?></td>
                <?php foreach($bugs as $id => $bug):?>
                <?php if($id != 0) echo "<tr class='text-center'>"?>
                  <td><?php echo $bug->id;?></td>
                  <td class="text-left" title="<?php echo $bug->title;?>"><?php echo $bug->title;?></td>
                  <td><span class='<?php echo 'pri' . $bug->pri?>'><?php echo $bug->pri;?></span></td>
                  <td><span class='<?php echo 'severity' . $bug->severity?>'><?php echo $bug->severity;?></span></td>
                  <td><?php echo zget($users, $bug->openedBy);?></td>
                  <td><?php echo substr($bug->openedDate, 0, 10);?></td>
                  <td><?php echo substr($bug->assignedDate, 0, 10);?></td>
                  <td><?php echo $lang->bug->statusList[$bug->status];?></td>
                <?php if($id != 0) echo "</tr>"?>
                <?php endforeach;?>
              </tr>
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
