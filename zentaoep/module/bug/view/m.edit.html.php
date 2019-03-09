<?php
/**
 * The edit mobile view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     bug
 * @version     $Id$
 * @link        http://www.zentao.net
 */
js::set('page'                   , 'edit');
js::set('changeProjectConfirmed' , false);
js::set('oldProjectID'           , $bug->project);
js::set('oldStoryID'             , $bug->story);
js::set('oldTaskID'              , $bug->task);
js::set('oldOpenedBuild'         , $bug->openedBuild);
js::set('oldResolvedBuild'       , $bug->resolvedBuild);
?>
<div class='heading divider'>
  <div class='title'><strong><?php echo $lang->bug->edit; ?></strong> #<?php echo $bug->id ?></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>

<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('bug', 'edit', "id=$bug->id")?>' id='editForm' data-form-refresh='#page' enctype='multipart/form-data'>
  <div class="box">
    <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
      <a class="active" data-target="#editView"><?php echo $lang->bug->view?></a>
      <a data-target="#editBasicInfo"><?php echo $lang->bug->legendBasicInfo?></a>
      <a data-target="#editLife"><?php echo $lang->bug->legendLife?></a>
      <a data-target="#editPrjStoryTask"><?php echo $lang->bug->legendPrjStoryTask?></a>
    </nav>
    <div>
      <div class="box display in" id="editView">
        <div class="control">
          <label for='title'><?php echo $lang->bug->title;?></label>
          <?php echo html::input('title',  str_replace("'","&#039;",$bug->title), "class='input'");?>
        </div>
        <div class="control">
          <label for='steps'><?php echo $lang->bug->legendSteps;?></label>
          <?php echo html::textarea('steps',  htmlspecialchars($bug->steps), "rows='4' class='textarea'");?>
        </div>
        <div class='control'>
          <label for='comment'><?php echo $lang->story->comment;?></label>
          <?php echo html::textarea('comment', '', 'rows=2 class="textarea"');?>
        </div>
        <div class='control'>
          <?php echo $this->fetch('file', 'buildform');?>
        </div>
      </div>
      <div class="box display hidden" id="editBasicInfo">
        <?php if($this->session->currentProductType != 'normal'):?>
        <div class='control'>
          <label for='branch'><?php echo $lang->bug->branch;?></label>
          <div class='select'> <?php echo html::select('branch', $branches, $bug->branch, "onchange='loadBranch()'");?></div>
        </div>
        <?php endif;?>
        <div class='control'>
          <label for='module'><?php echo $lang->bug->module;?></label>
          <div class='select' id='moduleIdBox'><?php echo html::select('module', $moduleOptionMenu, $currentModuleID, "onchange='loadModuleRelated()'");?></div>
        </div>
        <div class='control'>
          <label for='plan'><?php echo $lang->bug->productplan;?></label>
          <div class='select' id="planIdBox"><?php echo html::select('plan', $plans, $bug->plan);?></div>
        </div>
        <div class='control'>
          <label for='type'><?php echo $lang->bug->type;?></label>
          <div class='select'>
            <?php
            /**
             * Remove designchange, newfeature, trackings from the typeList, because should be tracked in story or task. 
             * These thress types if upgrade from bugfree2.x.
             */
            if($bug->type != 'designchange') unset($lang->bug->typeList['designchange']);
            if($bug->type != 'newfeature')   unset($lang->bug->typeList['newfeature']);
            if($bug->type != 'trackthings')  unset($lang->bug->typeList['trackthings']);
            echo html::select('type', $lang->bug->typeList, $bug->type);
            ?>
          </div>
        </div>
        <div class='control'>
          <label for='severity'><?php echo $lang->bug->severity;?></label>
          <div class='select'><?php echo html::select('severity', $lang->bug->severityList, $bug->severity);?></div>
        </div>
        <div class='control'>
          <label for='pri'><?php echo $lang->bug->pri;?></label>
          <div class='select'><?php echo html::select('pri', $lang->bug->priList, $bug->pri);?></div>
        </div>
        <div class='control'>
          <label for='status'><?php echo $lang->bug->status;?></label>
          <div class='select'><?php echo html::select('status', $lang->bug->statusList, $bug->status);?></div>
        </div>
        <div class='control'>
          <label for='confirmed'><?php echo $lang->bug->confirmed;?></label>
          <?php echo $lang->bug->confirmedList[$bug->confirmed];?>
        </div>
        <div class='control'>
          <label for='assignedTo'><?php echo $lang->bug->assignedTo;?></label>
          <div class='select'><?php echo html::select('assignedTo', $users, $bug->assignedTo);?></div>
        </div>
        <div class='control'>
          <label for='deadline'><?php echo $lang->bug->deadline;?></label>
          <input type='date' name='deadline' id='deadline' value='<?php echo $bug->deadline == '0000-00-00' ? '' : $bug->deadline?>' class='input' />
        </div>
        <div class='control'>
          <label for='os'><?php echo $lang->bug->os;?></label>
          <div class='select'><?php echo html::select('os', $lang->bug->osList, $bug->os);?></div>
        </div>
        <div class='control'>
          <label for='browser'><?php echo $lang->bug->browser;?></label>
          <div class='select'><?php echo html::select('browser', $lang->bug->browserList, $bug->browser);?></div>
        </div>
        <div class='control'>
          <label for='keywords'><?php echo $lang->bug->keywords;?></label>
          <?php echo html::input('keywords', $bug->keywords, 'class="input"');?>
        </div>
        <div class='control'>
          <label for='mailto'><?php echo $lang->bug->mailto;?></label>
          <div class='select'><?php echo html::select('mailto[]', $users, str_replace(' ', '', $bug->mailto), 'multiple');?></div>
        </div>
      </div>
      <div class="box display hidden" id="editLife">
        <div class='control'>
          <label for='openedBy'><?php echo $lang->bug->openedBy;?></label>
          <div><?php echo $users[$bug->openedBy];?></div>
        </div>
        <div class='control'>
          <div>
            <label for='openedBuild'><strong><?php echo $lang->bug->openedBuild;?></strong></label>
            <span><?php echo html::commonButton($lang->bug->allBuilds, "class='btn btn-default' onclick='loadAllBuilds(this)'")?></span>
          </div>
          <div class='select' id='openedBuildBox'>
            <?php echo html::select('openedBuild[]', $openedBuilds, $bug->openedBuild, 'multiple');?>
          </div>
        </div>
        <div class='control'>
          <label for='resolvedBy'><?php echo $lang->bug->resolvedBy;?></label>
          <div class='select'><?php echo html::select('resolvedBy', $users, $bug->resolvedBy);?></div>
        </div>
        <div class='control'>
          <label for='resolvedDate'><?php echo $lang->bug->resolvedDate;?></label>
          <?php echo html::input('resolvedDate', $bug->resolvedDate, "class='input'");?>
        </div>
        <div class='control'>
          <div>
            <label for='resolvedBuild'><strong><?php echo $lang->bug->resolvedBuild;?></strong></label>
            <span><?php echo html::commonButton($lang->bug->allBuilds, "class='btn btn-default' onclick='loadAllBuilds(this)'")?></span>
          </div>
          <div class='select' id='resolvedBuildBox'><?php echo html::select('resolvedBuild', $resolvedBuilds, $bug->resolvedBuild);?></div>
        </div>
        <div class='control'>
          <label for='resolution'><?php echo $lang->bug->resolution;?></label>
          <div class='select'><?php echo html::select('resolution', $lang->bug->resolutionList, $bug->resolution, 'onchange=setDuplicate(this.value)');?></div>
        </div>
        <div class='control <?php if($bug->resolution != 'duplicate') echo 'hidden'?>' id='duplicateBugBox'>
          <label for='duplicateBug'><?php echo $lang->bug->duplicateBug;?></label>
          <?php echo html::input('duplicateBug', $bug->duplicateBug, "class='input'");?>
        </div>
        <div class='control'>
          <label for='closedBy'><?php echo $lang->bug->closedBy;?></label>
          <div class='select'><?php echo html::select('closedBy', $users, $bug->closedBy);?></div>
        </div>
        <div class='control'>
          <label for='closedDate'><?php echo $lang->bug->closedDate;?></label>
          <?php echo html::input('closedDate', $bug->closedDate, "class='input'");?>
        </div>
      </div>
      <?php if($config->global->flow != 'onlyTest'):?>
      <div class="box display hidden" id="editPrjStoryTask">
        <div class='control'>
          <label for='project'><?php echo $lang->bug->project;?></label>
          <div class='select' id='projectIdBox'><?php echo html::select('project', $projects, $bug->project, "onchange='loadProjectRelated(this.value)'");?></div>
        </div>
        <div class='control'>
          <label for='story'><?php echo $lang->bug->story;?></label>
          <div class='select' id='storyIdBox'><?php echo html::select('story', $stories, $bug->story);?></div>
        </div>
        <div class='control'>
          <label for='task'><?php echo $lang->bug->task;?></label>
          <div class='select' id='taskIdBox'><?php echo html::select('task', $tasks, $bug->task);?></div>
        </div>
      </div>
      <?php endif;?>
    </div>
  </div>
  <?php echo html::hidden('product', $bug->product);?>
</form>

<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    $('#submitButton').click(function(){$('#editForm').submit()});
});
</script>
