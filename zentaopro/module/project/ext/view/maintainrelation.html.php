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
      <form method='post' class='load-indicator main-form' target='hiddenwin'>
        <?php if(!empty($relations)):?>
        <table class='table table-fixed mgb-20 table-form with-border'>
          <thead>
          <tr class='colhead text-center'>
            <th class='w-id'><?php echo $lang->project->gantt->id;?></th>
            <th><?php echo $lang->project->gantt->pretask;?></th>
            <th class='w-130px'><?php echo $lang->project->gantt->condition;?></th>
            <th><?php echo $lang->project->gantt->task;?></th>
            <th class='w-140px'><?php echo $lang->project->gantt->action;?></th>
          </tr>
          </thead>
          <tbody>
          <?php foreach($relations as $id => $relation):?>
          <?php
          $tasksClone = $tasks;
          unset($tasksClone[$relation->pretask]);
          ?>
          <tr>
            <td><?php echo $id . html::hidden("id[$id]", "$id");?></td>
            <td style='overflow:visible'><?php echo html::select("pretask[$id]", $tasks, $relation->pretask, "class='form-control chosen' onchange='deleteself(this, $id, \"\")'");?></td> 
            <td><?php echo html::select("condition[$id]", $lang->project->gantt->preTaskStatus, $relation->condition, 'class=form-control');?> </td>
            <td style='overflow:visible'><?php echo html::select("task[$id]", $tasksClone, $relation->task, "class='form-control chosen'");?> </td>
            <td><?php echo html::select("action[$id]", $lang->project->gantt->taskActions, $relation->action, 'class=form-control');?> </td>
          </tr>
          <?php endforeach;?>
          </tbody>
        </table>
        <?php endif;?>
        <table class='table table-form table-fixed with-border'>
          <caption class='text-left'><strong><?php echo $lang->project->gantt->newCreateRelationOfTasks;?></strong></caption>
          <thead>
          <tr class='colhead text-center'>
            <th class='w-id'><?php echo $lang->project->gantt->id;?></th>
            <th><?php echo $lang->project->gantt->pretask;?></th>
            <th class='w-130px'><?php echo $lang->project->gantt->condition;?></th>
            <th><?php echo $lang->project->gantt->task;?></th>
            <th class='w-140px'><?php echo $lang->project->gantt->action;?></th>
          </tr>
          </thead>
          <tbody>
          <?php for($i = 1 ; $i <= 5 ; $i++):?>
          <tr>
            <td class='text-center'><?php echo $i . html::hidden("newid[$i]", $i);?></td>
            <td style='overflow:visible'><?php echo html::select("newpretask[$i]", $tasks, '', "class='form-control chosen' onchange='deleteself(this, $i, \"new\")'");?> </td>
            <td><?php echo html::select("newcondition[$i]", $lang->project->gantt->preTaskStatus, '', 'class=form-control');?> </td>
            <td style='overflow:visible'><?php echo html::select("newtask[$i]", $tasks, '', "class='form-control chosen'");?> </td>
            <td><?php echo html::select("newaction[$i]", $lang->project->gantt->taskActions, '', 'class=form-control');?> </td>
          </tr>
          <?php endfor;?>
          </tbody>
          <tfoot>
          <tr>
            <td colspan='5' class='text-center form-actions'>
              <?php echo html::submitButton() . html::backButton();?>
            </td>
          </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script language='Javascript'>
$('#ganttTab').addClass('active');
$('#maintainRelation').addClass('active');
function deleteself(obj, i, isnew)
{
    var value = $(obj).val();
    var options = '';
    $(obj).find('option').each(function(){
        var optionValue = $(this).attr('value');
        if(optionValue != value || optionValue == '') options = options + "<option value='" + optionValue + "'>" + $(this).html() + "</option>";
    });
    $('select').each(function()
    {
        if($(this).attr('name') == isnew + "task[" + i + "]")
        {
            $(this).html(options);
            $(this).trigger("chosen:updated");
        }
    });
}
</script>
<?php include '../../../common/view/footer.html.php';?>
