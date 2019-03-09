<?php
/**
 * The view file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     company 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php if($iframe == 'yes'):?>
<?php $type = 'effort';?>
<?php 
for($i = strtotime($begin); $i <= strtotime($end); $i +=86400)
{
    $days[] = date('Y-m-d', $i); 
}
?>
<table class="table table-bordered table-striped table-condensed table-fixed datatable no-margin" id='effortList'>
  <thead>
    <tr>
      <th class='w-100px' data-width='100'><?php echo $lang->company->dept;?></th>
      <th class='w-100px' data-width='100'><?php echo $lang->company->user;?></th>
      <?php foreach($days as $day) echo "<th data-width='200' class='flex-col'>" . $day . '</th>';?>
    </tr>
  </thead>
  <tbody>
    <?php foreach($datas as $deptID => $deptData):?>

    <?php foreach($deptData as $account => $userData):?>
    <?php if(empty($userData)) continue;?>
    <tr class='text-top'>
      <td class="text-middle"><?php echo isset($depts[$deptID]) ? $depts[$deptID] : $lang->company->currentDept;?></td>
      <td class="text-middle"><?php echo zget($users, $account);?></td>
      <?php foreach($days as $day):?>
      <td id='diary-title'>
        <?php 
        if(isset($userData[$day]))
        {
            if($type == 'todo')
            {
                foreach($userData[$day] as $work)
                {
                    echo "<p class='todo' title='{$work['todo']}'>";
                    echo (empty($work['begin'])) ? "<span style='margin-right:75px;'></span>" : '<span>' . $work['begin'] . '~' . $work['end'] . '</span> ';
                    echo $work['todo'] . '</p>';
                }
            }
            else
            {
                echo '<ol class="effort-list">';
                foreach($userData[$day] as $work) echo "<li title='{$work['work']} ({$work['consumed']}h)'>" . $work['work'] . " ({$work['consumed']}h)" . '</li>'; 
                echo '</ol>';
            }
        }
        ?>
      </td>
      <?php endforeach;?>
    </tr>
    <?php unset($deptData[$account]);?>
    <?php endforeach;?>

    <?php foreach($deptData as $account => $userData):?>
    <tr valign="top">
      <td class='text-middle'><?php echo isset($depts[$deptID]) ? $depts[$deptID] : $lang->company->currentDept;?></td>
      <td class='text-middle'><?php echo zget($users, $account);?></td>
      <?php foreach($days as $day):?>
      <td></td>
      <?php endforeach;?>
    </tr>
    <?php endforeach;?>
    <?php endforeach;?>
  </tbody>
</table>
<?php exit;?>
<?php endif;?>

<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php include '../../../common/view/datatable.html.php';?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'>
    <?php 
    echo html::a(inlink('calendar'), "<span class='text'>{$lang->company->calendar}</span>", '', "class='btn btn-link btn-active-text' id='calendarTab'");
    echo html::a(inlink('effort', "date=today"),     "<span class='text'>{$lang->effort->todayEfforts}</span>",     '', "class='btn btn-link' id='today'"    );
    echo html::a(inlink('effort', "date=yesterday"), "<span class='text'>{$lang->effort->yesterdayEfforts}</span>", '', "class='btn btn-link' id='yesterday'");
    echo html::a(inlink('effort', "date=thisweek"),  "<span class='text'>{$lang->effort->thisWeekEfforts}</span>",  '', "class='btn btn-link' id='thisweek'" );
    echo html::a(inlink('effort', "date=lastweek"),  "<span class='text'>{$lang->effort->lastWeekEfforts}</span>",  '', "class='btn btn-link' id='lastweek'" );
    echo html::a(inlink('effort', "date=thismonth"), "<span class='text'>{$lang->effort->thisMonthEfforts}</span>", '', "class='btn btn-link' id='thismonth'");
    echo html::a(inlink('effort', "date=lastmonth"), "<span class='text'>{$lang->effort->lastMonthEfforts}</span>", '', "class='btn btn-link' id='lastmonth'");
    echo html::a(inlink('effort', "date=all"),       "<span class='text'>{$lang->effort->allDaysEfforts}</span>",   '', "class='btn btn-link' id='all'"      );
    ?>
  </div>
  <div class='btn-toolbar pull-right'><?php common::printIcon('effort', 'export', "account=$account&orderBy=date_asc", '', 'button', '', '', 'export');?></div>
</div>
<div id="mainContent" class="main-row fade">
  <div class="side-col" id="sidebar">
    <div class="sidebar-toggle"><i class="icon icon-angle-left"></i></div>
    <div class='cell'>
      <form method='post' target='hiddenwin' action='<?php echo $this->createLink('company', 'calendar');?>'>
        <div class='detail'>
          <div class='detail-title'><?php echo $lang->company->effortCalendar;?></div>
          <div class='detail-content'>
            <div class='form-group'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->company->dept;?></span>
                <?php echo html::select('dept', $mainDepts, $parent, "class='form-control chosen' onchange='loadDeptUsers(this.value)'");?>
              </div>
            </div>
            <div class='form-group'>
              <div id='userBox' class='input-group'>
                <span class='input-group-addon'><?php echo $lang->company->user;?></span>
                <?php echo html::select('user', $users, $account, 'class="form-control chosen"');?>
              </div>
            </div>
            <div class='form-group'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->company->beginDate;?></span>
                <?php echo html::input('begin', $begin, 'class="form-control form-date"');?>
              </div>
            </div>
            <div class='form-group'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->company->endDate;?></span>
                <?php echo html::input('end', $end, 'class="form-control form-date"');?>
              </div>
            </div>
            <div class='form-group'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->company->product;?></span>
                <?php echo html::select('product', $products, $product, 'class="form-control chosen" onchange="loadProductProjects(this.value)"');?>
              </div>
            </div>
            <div class='form-group'>
              <div id='projectIdBox' class='input-group'>
                <span class='input-group-addon'><?php echo $lang->company->project;?></span>
                <?php echo html::select('project', $projects, $project, 'class="form-control chosen"');?>
              </div>
            </div>
            <div class='form-group'>
              <div class='input-group'>
                <label class="checkbox-inline">
                  <input type="checkbox" name="showAll" value="1" id="showAll" <?php echo $showAll ? 'checked' : ''?>>
                  <?php echo $lang->company->showAll?>
                </label>
              </div>
            </div>
            <div class='form-group'><?php echo html::submitButton($lang->company->effort->view);?></div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="main-col cell">
    <div id='showdata' data-url='<?php echo $this->createLink('company', 'calendar', "dept=$parent&begin=" . strtotime($begin) . "&end=" . strtotime($end) . "&product=$product&project=$project&user=$account&showAll=$showAll&iframe=yes")?>'>
      <div style='padding: 40px;' class='text-center'><i class='icon-spinner icon-spin' style='font-size: 28px'></i></div>
    </div>
  </div>
</div>
<?php include '../../../common/view/footer.html.php';?>
