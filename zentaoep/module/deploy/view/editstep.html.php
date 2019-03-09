<?php
/**
 * The create view file of deploy module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     deploy
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->deploy->editStep;?></h2>
  </div>
  <form method='post' target='hiddenwin'>
    <table class='table table-form'> 
      <tr>
        <th class='w-100px'><?php echo $lang->deploy->lblBeginEnd;?></th>
        <td class='w-p30'>
          <div class='input-group'>
            <?php echo html::input('begin', substr($step->begin, 0, 16), "class='form-control form-datetime' placeholder='{$lang->deploy->begin}'");?>
            <span class='input-group-addon fix-border'>~</span>
            <?php echo html::input('end', substr($step->end, 0, 16), "class='form-control form-datetime' placeholder='{$lang->deploy->end}'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->assignedTo;?></th>
        <td><?php echo html::select('assignedTo', $users, $step->assignedTo, "class='form-control chosen'");?></td><td></td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->stage;?></th>
        <td><?php echo html::select('stage', $lang->deploy->stageList, $step->stage, "class='form-control chosen'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->status;?></th>
        <td>
            <?php echo html::select('status', $lang->deploy->statusList, $step->status, "class='form-control'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->finishedBy;?></th>
        <td>
            <?php echo html::select('finishedBy', $users, $step->finishedBy, "class='form-control chosen'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->title;?></th>
        <td colspan='2'><?php echo html::input('title', $step->title, "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->content;?></th>
        <td colspan='2'><?php echo html::textarea('content', str_replace(array('<br>', '<br />'), '', $step->content), "rows='10' style='height:100px;' class='form-control'");?></td>
      </tr>
      <tr>
        <td colspan='3' class='text-center form-actions'>
          <?php echo html::submitButton();?>
          <?php echo html::backButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
