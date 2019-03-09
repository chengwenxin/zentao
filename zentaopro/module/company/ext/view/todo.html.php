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
<?php
if($iframe == 'yes')
{
    $type = 'todo';
    die(include './showdata.html.php');
}
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php include '../../../common/view/datatable.html.php';?>
<?php 
for($i = strtotime($begin); $i <= strtotime($end); $i +=86400)
{
    $days[] = date('Y-m-d', $i); 
}
?>
<div id="mainContent" class="main-row fade">
  <div class="side-col" id="sidebar">
    <div class="sidebar-toggle"><i class="icon icon-angle-left"></i></div>
    <div class='cell'>
      <form method='post' class='form-condensed' target='hiddenwin' action='<?php echo $this->createLink('company', 'todo');?>'>
        <div class='detail'>
          <div class='detail-title'><?php echo $lang->company->todoCalendar;?></div>
          <div class='detail-content'>
            <div class='form-group'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->company->dept;?></span>
                <?php echo html::select('dept', $mainDepts, $parent, "class='form-control chosen'");?>
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
            <div class='form-group'><?php echo html::submitButton($lang->company->effort->view);?></div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="main-col cell">
    <div id='showdata' data-url='<?php echo $this->createLink('company', 'todo', "dept=$parent&begin=" . strtotime($begin) . "&end=" . strtotime($end) . "&iframe=yes")?>'>
      <div style='padding: 40px;' class='text-center'><i class='icon-spinner icon-spin' style='font-size: 28px'></i></div>
    </div>
  </div>
</div>
<?php include '../../../common/view/footer.html.php';?>
