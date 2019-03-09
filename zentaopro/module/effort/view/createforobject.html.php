<?php
/**
 * The create view of effort module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     effort
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('noticeSaveRecord', $this->lang->effort->noticeSaveRecord);?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->effort->create;?></h2>
  </div>
  <form method='post' action='<?php echo $this->createLink('effort', 'createForObject', "objectType=$objectType&objectID=$objectID");?>' target='hiddenwin'>
    <?php if($efforts):?>
    <table class='table table-form table-fixed' id='objectTable' style='margin-bottom:10px;'>
      <thead>
        <tr>
          <th class='w-id'><?php echo $lang->idAB;?></th>
          <th class='w-120px'><?php echo $lang->effort->date;?></th>
          <th class='w-60px'><?php echo $lang->effort->consumed;?></th>
          <?php if($objectType == 'task'):?>
          <th class='w-60px'><?php echo $lang->effort->left;?></th>
          <?php endif;?>
          <th><?php echo $lang->effort->work;?></th>
          <th class='w-80px'><?php if(empty($task->team) or  $task->assignedTo == $this->app->user->account)echo $lang->actions;?></th>
        </tr>  
      </thead>
      <tbody>
        <?php foreach($efforts as $effort):?>
        <tr class='main'>
          <td align='center'><?php echo $effort->id?></td>
          <td align='center'><?php echo $effort->date?></td>
          <td align='center'><?php echo $effort->consumed?></td>
          <?php if($objectType == 'task'):?>
          <td align='center'><?php echo $effort->left;?></td>
          <?php endif;?>
          <td><?php echo $effort->work;?></td>
          <td align='center' class='actions'>
            <?php
             if(empty($task->team) or  $task->assignedTo == $this->app->user->account)common::printIcon('effort', 'edit', "effortID=$effort->id", '', 'button', '', '', 'showinonlybody', true);
             if(empty($task->team) or  $task->assignedTo == $this->app->user->account)common::printIcon('effort', 'delete', "effortID=$effort->id", '', 'button', '', 'hiddenwin', 'showinonlybody');
            ?>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <?php else:?>
    <div style='padding-top:45px'></div>
    <?php endif;?>
    <?php if(!empty($task->team) && $task->assignedTo != $this->app->user->account):?>
    <div class="alert with-icon">
      <i class="icon-exclamation-sign icon-rotate-180"></i>
      <div class="content">
        <p><?php echo sprintf($lang->task->deniedNotice, '<strong>' . $task->assignedToRealName . '</strong>', $lang->task->logEfforts);?></p>
      </div>
    </div>
    <?php else:?>
    <table class='table table-form table-fixed' style='margin-bottom:20px;border:1px solid #ddd;'>
      <thead>
        <tr>
          <th class='w-id'><?php echo $lang->idAB;?></th>
          <th class='w-120px'><?php echo $lang->effort->date;?></th>
          <th class='w-60px'><?php echo $lang->effort->consumed;?></th>
          <?php if($objectType == 'task'):?>
          <th class='w-60px'><?php echo $lang->effort->left;?></th>
          <?php endif;?>
          <th><?php echo $lang->effort->work;?></th>
        </tr>  
      </thead>
      <tbody>
        <?php $today = date(DT_DATE1);?>
        <?php for($i = 1; $i <= 3; $i++):?>
        <tr class='text-top'>
          <td align='center'><?php echo $i . html::hidden("id[$i]", $i);?></td>
          <td><?php echo html::input("dates[$i]", $today, "class='form-control form-date'");?></td>
          <td><?php echo html::input("consumed[$i]", '', "class='form-control' autocomplete='off'");?></td>
          <?php if($objectType == 'task'):?>
          <td><?php echo html::input("left[$i]", '', "class='form-control' autocomplete='off'");?></td>
          <?php endif;?>
          <td>
          <?php
          echo html::hidden("objectType[$i]", $objectType); 
          echo html::hidden("objectID[$i]", $objectID); 
          echo html::textarea("work[$i]", '', "class='form-control' style='height:50px'");
          ?>
          </td>
        </tr>  
        <?php endfor;?>
      </tbody>
      <tfoot>
        <tr>
          <?php $colspan = $objectType == 'task' ? '5' : '4';?>
          <td colspan='<?php echo $colspan?>' class="text-center form-actions">
            <?php echo html::submitButton('', "onclick='return checkTaskLeft(\"{$lang->effort->noticeFinish}\")'");?>
            <?php echo html::backButton();?>
          </td>
        </tr>
      </tfoot>
    </table>
    <?php endif;?>
  </form>
</div>
<?php include '../../common/view/footer.lite.html.php'?>
