<?php
/**
 * The create mobile view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     bug
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <div class='title'><i class='icon-plus muted'></i> <strong><?php echo $lang->bug->create; ?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>

<form class='has-padding content' method='post' action='<?php echo $this->createLink('bug', 'create', http_build_query($this->app->getParams()))?>' id='createForm' data-form-refresh='#page' enctype='multipart/form-data'>
  <?php if($branches):?>
  <div class="control">
    <label for='branch'><?php echo $lang->bug->branch;?></label>
    <div class='select'><?php echo html::select('branch', $branches, $branch, "onchange='loadBranch()'");?></div>
  </div>
  <?php endif;?>
  <div class="control">
    <label for='module'><?php echo $lang->bug->module;?></label>
    <div id='moduleIdBox' class='select'><?php echo html::select('module', $moduleOptionMenu, $moduleID);?></div>
  </div>
  <div class="control">
    <div>
      <label for='openedBuild' class='strong'><?php echo $lang->bug->openedBuild;?></label>
      <span><?php echo html::commonButton($lang->bug->allBuilds, "class='btn btn-default' data-toggle='tooltip' onclick='loadAllBuilds()'")?></span>
    </div>
    <div id='buildBox' class='select'><?php echo html::select('openedBuild[]', $builds, $buildID, "multiple");?></div>
  </div>
  <?php if(strpos(",$showFields,", ',project,') !== false and $config->global->flow != 'onlyTest'):?>
  <div class="control">
    <label for='project'><?php echo $lang->bug->project;?></label>
    <div id='projectIdBox' class='select'><?php echo html::select('project', $projects, $projectID);?></div>
  </div>
  <?php endif;?>
  <div class="control">
    <div>
      <label for='assignedTo' class='strong'><?php echo $lang->bug->lblAssignedTo;?></label>
      <span><?php echo html::commonButton($lang->bug->allUsers, "class='btn btn-default' onclick='loadAllUsers()' data-toggle='tooltip'");?></span>
    </div>
    <div id='assignedToBox' class='select'><?php echo html::select('assignedTo', $projectMembers, $assignedTo);?></div>
  </div>
  <div class="control">
    <label for='title'><?php echo $lang->bug->title;?></label>
    <?php echo html::input('title', $bugTitle, "class='input'");?>
  </div>
  <?php $showSeverity = strpos(",$showFields,", ',severity,') !== false;?>
  <?php $showPri      = strpos(",$showFields,", ',pri,')      !== false;?>
  <?php if($showSeverity or $showPri):?>
  <div class='row'>
    <?php if($showSeverity):?>
    <div class='cell'>
      <div class='control'>
        <label for='severity'><?php echo $lang->bug->severity;?></label>
        <div class='select'><?php echo html::select('severity', $lang->bug->severityList, $severity);?></div>
      </div>
    </div>
    <?php endif;?>
    <?php if($showPri):?>
    <div class='cell'>
      <div class='control'>
        <label for='pri'><?php echo $lang->bug->pri;?></label>
        <div class='select'><?php echo html::select('pri', $lang->bug->priList, '');?></div>
      </div>
    </div>
    <?php endif;?>
  </div>
  <?php endif;?>
  <div class="control">
    <label for='steps'><?php echo $lang->bug->steps;?></label>
    <?php echo html::textarea('steps', $steps, "rows=4 class='textarea'");?>
  </div>
  <div class='row'>
    <div class='cell'>
      <div class='control'>
        <label for='type'><?php echo $lang->bug->type;?></label>
        <?php
        unset($lang->bug->typeList['designchange']);
        unset($lang->bug->typeList['newfeature']);
        unset($lang->bug->typeList['trackthings']);
        ?>
        <div class='select'><?php echo html::select('type', $lang->bug->typeList, $type);?></div>
      </div>
    </div>
    <?php if(strpos(",$showFields,", ',os,') !== false):?>
    <div class='cell'>
      <div class='control'>
        <label for='os'><?php echo $lang->bug->os;?></label>
        <div class='select'><?php echo html::select('os', $lang->bug->osList, $os);?></div>
      </div>
    </div>
    <?php endif;?>
    <?php if(strpos(",$showFields,", ',browser,') !== false):?>
    <div class='cell'>
      <div class='control'>
        <label for='browser'><?php echo $lang->bug->browser;?></label>
        <div class='select'><?php echo html::select('browser', $lang->bug->browserList, $browser);?></div>
      </div>
    </div>
    <?php endif;?>
  </div>
  <?php if(strpos(",$showFields,", ',deadline,') !== false):?>
  <div class="row">
    <div class="control">
      <label for='deadline'><?php echo $lang->bug->deadline;?></label>
      <input type="date" value='<?php echo $deadline ?>' name='deadline' id='deadline' class='input'>
    </div>
  </div>
  <?php endif;?>
  <?php if(strpos(",$showFields,", ',story,') !== false and $config->global->flow != 'onlyTest'):?>
    <div class='control'>
      <label for='story'><?php echo $lang->bug->story;?></label>
      <div class='select' id='storyIdBox'><?php echo html::select('story', empty($stories) ? '' : $stories, $storyID);?></div>
    </div>
  <?php endif;?>
  <?php if(strpos(",$showFields,", ',task,')  !== false and $config->global->flow != 'onlyTest'):?>
    <div class='control'>
      <label for='task'><?php echo $lang->bug->task;?></label>
      <div class='select' id='taskIdBox'><?php echo html::select('task', '', $taskID);?></div>
    </div>
  <?php endif;?>
  <?php if(strpos(",$showFields,", ',mailto,') !== false):?>
  <div class="row">
    <div class="control">
      <label for='mailto'><?php echo $lang->bug->mailto;?></label>
      <div class='select'> <?php echo html::select('mailto[]', $users, str_replace(' ' , '', $mailto), "multiple");?></div>
    </div>
    <?php echo $this->fetch('my', 'buildContactLists');?>
  </div>
  <?php endif;?>
  <?php if(strpos(",$showFields,", ',keywords,') !== false):?>
  <div class="control">
    <label for='keywords'><?php echo $lang->bug->keywords;?></label>
    <?php echo html::input('keywords', $keywords, "class='input'");?></div>
  </div>
  <?php endif;?>
  <div class='control'>
    <?php echo $this->fetch('file', 'buildForm', 'fileCount=1');?>
  </div>
  <?php echo html::hidden('product', $productID);?>
</form>

<div class='footer has-padding'>
  <button type='button' data-submit='#createForm' class='btn primary'><?php echo $lang->save ?></button>
</div>
<?php js::set('page', 'create');?>
<script>
$(function()
{
    $('#createForm').modalForm().listenScroll({container: 'parent'});
    var textarea = $('#steps');
    textarea.val(textarea.val().replace(/<br\/>/g,'\n').replace(/<[^>].*?>/g,''));
})
</script>
