<?php
/**
 * The task create mobile view file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     task 
 * @version     $Id
 * @link        http://www.zentao.net
 */
?>

<div class='heading divider'>
  <div class='title'><i class='icon-plus muted'></i> <strong><?php echo $lang->task->create;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>
<form class='content box' data-form-refresh='#page' method='post' id='createTaskForm' action='<?php echo $this->createLink('task', 'batchcreate', http_build_query($this->app->getParams()));?>'>
  <div class="control">
    <label for='module'><?php echo $lang->task->module;?></label>
    <div class='select'>
      <?php echo html::select('module[]', $modules, $moduleID, "onchange='setStories(this.value, $project->id)'");?>
      <?php echo html::hidden("parent[]", $parent);?>
    </div>
  </div>
  <div class="control">
    <label for='type'><?php echo $lang->task->type;?></label>
    <div class='select'><?php echo html::select('type[]', $lang->task->typeList);?></div>
  </div>
  <div class='control'>
    <label for='assignedTo'><?php echo $lang->task->assignedTo;?></label>
    <div class='select'>
      <?php echo html::select('assignedTo[]', $members);?>
    </div>
  </div>
  <?php if(strpos(",$showFields,", ',story,') !== false and $config->global->flow != 'onlyTask'):?>
  <div class='control'>
    <label for='story'><?php echo $lang->task->story;?></label>
    <div class='select'><?php echo html::select('story[]', array(0 => '') + $stories, $storyID, 'onchange=setStoryModule()');?></div>
  </div>
  <?php endif;?>
  <div class='control'>
    <label for='name'><?php echo $lang->task->name;?></label>
    <?php echo html::input('name[]', '', "class='input' placeholder='{$lang->required}'");?>
    <?php echo html::hidden('color[]', '');?>
  </div>
  <div class='row'>
    <?php if(strpos(",$showFields,", ',pri,') !== false):?>
    <div class='cell-6'>
      <div class='control'>
        <label for='pri'><?php echo $lang->task->pri;?></label>
        <div class='select'><?php echo html::select('pri[]', $lang->task->priList);?></div>
      </div>
    </div>
    <?php endif;?>
    <?php if(strpos(",$showFields,", ',estimate,') !== false):?>
    <div class='cell-6'>
      <div class='control'>
        <label for='estimate'><?php echo $lang->task->estimate;?></label>
        <?php echo html::input('estimate[]', '', "class='input'");?>
      </div>
    </div>
    <?php endif;?>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->task->desc;?></label>
    <?php echo html::textarea('desc[]', '', "rews='5' class='textarea'");?>
  </div>
  <div class='row'>
    <?php if(strpos(",$showFields,", ',estStarted,') !== false):?>
    <div class='cell-6'>
      <div class='control'>
        <label for='estStarted'><?php echo $lang->task->estStarted;?></label>
        <input type='date' class='input' id='estStarted[]' name='estStarted[]'>
      </div>
    </div>
    <?php endif;?>
    <?php if(strpos(",$showFields,", ',deadline,') !== false):?>
    <div class='cell-6'>
      <div class='control'>
        <label for='deadline'><?php echo $lang->task->deadline;?></label>
        <input type='date' class='input' id='deadline[]' name='deadline[]'>
      </div>
    </div>
    <?php endif;?>
  </div>
</form>
<div class='footer has-padding'>
  <button type='button' data-submit='#createTaskForm' class='btn primary'><?php echo $lang->save;?></button>
</div>

<div class='template'>
  <div class='row flex-nowrap'>
    <div class='cell'>
      <div class='control'>
        <div class='select'>
          <?php echo html::select("team[key]", $members);?>
        </div>
      </div>
    </div>
    <div class='cell-4'>
      <div class='control'>
        <?php echo html::input("teamEstimate[key]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->estimateAB}'") ?>
      </div>
    </div>
    <div class='cell flex-none'>
      <a class='btn member-deleter'><i class='icon-trash text-danger'></i></a>
    </div>
  </div>
</div>

<script>
function setStoryModule()
{
    var storyID = $('[name*=story]').val();
    if(storyID)
    {
        var link = createLink('story', 'ajaxGetModule', 'storyID=' + storyID);
        $.get(link, function(moduleID){$('[name*=module]').val(moduleID);});
    }
}

function setStories(moduleID, projectID)
{
    link = createLink('story', 'ajaxGetProjectStories', 'projectID=' + projectID + '&productID=0&branch=0&moduleID=' + moduleID);
    $.get(link, function(stories)
    {
        var storyID = $('[name*=story]').val();
        if(!stories) stories = '<select id="story0" name="story[]"></select>';
        $('[name*=story]').replaceWith(stories);
        $('[name*=story]').val(storyID);
    });
}
$(function()
{
    $('#createTaskForm').modalForm().listenScroll({container: 'parent'});
});
</script>
