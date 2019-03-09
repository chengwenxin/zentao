<?php
/**
 * The finish mobile view file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     task
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php if(!empty($task->team) && $task->assignedTo != $this->app->user->account):?>
<div class='heading'>
  <div class='title'><strong><?php echo $lang->task->tips;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
</div>
<div class='content article box'>
  <p><?php echo sprintf($lang->task->deniedNotice, '<strong>' . $task->assignedToRealName . '</strong>', $lang->task->finish);?></p>
</div>
<?php else:?>
<div class='heading divider'>
  <span class='title'><strong><?php echo $lang->task->finish;?></strong> #<?php echo $task->id . ' ' . $task->name;?></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('task', 'finish', "taskID=$task->id")?>' id='finishForm' data-form-refresh='#page' enctype='multipart/form-data'>
  <div class='control'>
    <label for='hasConsumed'><?php echo $lang->task->hasConsumed;?></label>
    <?php echo $task->consumed . $lang->workingHour;?>
  </div>
  <div class='control'>
    <label for='consumed'><?php echo $lang->task->consumed;?></label>
    <?php echo html::input('consumed', $task->consumed, "class='input'");?></div>
  </div>
  <div class='control'>
    <label for='assignedTo'><?php echo $lang->task->assignedTo;?></label>
    <div class='select'><?php echo html::select('assignedTo', $members, $task->openedBy);?></div>
  </div>
  <div class='control'>
    <label for='finishedDate'><?php echo $lang->task->finishedDate;?></label>
    <input type='date' class='input' id='finishedDate' name='finishedDate' value='<?php echo helper::today()?>'>
  </div>
  <div class='control'>
    <?php echo $this->fetch('file', 'buildForm', 'fileCount=1');?>
  </div>
  <div class='control'>
    <label for='comment'><?php echo $lang->comment;?></label>
    <?php echo html::textarea('comment', '', 'rows=2 class="textarea"');?></td>
  </div>
</form>
<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>

<script>
$(function()
{
    $('#submitButton').click(function(){$('#finishForm').submit()});
})
</script>
<?php endif;?>
