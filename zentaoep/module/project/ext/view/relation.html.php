<?php
/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     project 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include "featurebar.html.php";?>
<div id="mainContent" class="main-row hide-side">
  <div class='main-col'>
    <div class='cell'>
      <table class='table table-form main-table' target='hiddenwin'>
        <thead>
        <tr class='colhead text-center'>
          <th class='w-id'><?php echo $lang->project->gantt->id;?></th>
          <th><?php echo $lang->project->gantt->pretask;?></th>
          <th class='w-130px'><?php echo $lang->project->gantt->condition;?></th>
          <th><?php echo $lang->project->gantt->task;?></th>
          <th class='w-120px'><?php echo $lang->project->gantt->action;?></th>
          <th class='w-80px'><?php echo $lang->project->gantt->type;?></th>
          <th class='w-60px {sorter:false}'><?php echo $lang->actions;?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($relations as $id => $relation):?>
        <tr class='text-center'>
          <td><?php echo $id;?></td>
          <td class='text-left'><?php echo $tasks[$relation->pretask];?></td>
          <td><?php echo $lang->project->gantt->preTaskStatus[$relation->condition];?> </td>
          <td class='text-left'><?php echo $tasks[$relation->task];?> </td>
          <td><?php echo $lang->project->gantt->taskActions[$relation->action];?> </td>
          <td><?php echo $relation->condition == 'begin' ? 'S' : 'F'; echo $relation->action == 'begin' ? 'S' : 'F';?> </td>
          <td class='c-actions'><?php $lang->project->deleteRelation = $lang->delete; common::printIcon('project', 'deleteRelation', "id=$id&projectID=$projectID", '', 'list', 'trash', 'hiddenwin');?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script> $('#ganttTab').addClass('active'); </script>
<script> $('#relation').addClass('active'); </script>
<?php include '../../../common/view/footer.html.php';?>
