<?php
/**
 * The view mobile file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     task
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php
$bodyClass = 'with-nav-bottom';
include "../../common/view/m.header.html.php";

$isTaskDone   = $task->status == 'done';
$isTaskClosed = $task->status == 'closed';
$statusIcons  = array();
$statusIcons['wait']   = 'time';
$statusIcons['doing']  = 'play';
$statusIcons['done']   = 'check';
$statusIcons['cancel'] = 'times';
$statusIcons['closed'] = 'minus';
$headingColor = $isTaskClosed ? 'dark' : ($isTaskDone ? 'success' : 'pri-' . $task->pri);
$browseLink  = $app->session->taskList != false ? $app->session->taskList : $this->createLink('project', 'browse', "projectID=$task->project");
?>
<style>.pri-0 {background: #666;}</style>

<div id='page' class='list-with-actions'>
  <div class='heading gray'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $task->id;?></strong></span>
      <?php if(!empty($task->parent)) echo '<span class="label label-badge label-primary no-margin">' . $this->lang->task->childrenAB . '</span>';?>
      <?php if(!empty($task->team)) echo '<span class="label label-badge label-primary no-margin">' . $this->lang->task->multipleAB . '</span>';?>
      <strong>
        <?php echo isset($task->parentName) ? html::a(inlink('view', "taskID={$task->parent}"), $task->parentName) . ' / ' : '';?>
        <span style='color: <?php echo $task->color; ?>'><?php echo $task->name;?></span>
      </strong>
    </div>
    <nav class='nav'>
      <a href='<?php echo $browseLink;?>' class='btn primary'><?php echo $lang->goback;?></a>
    </nav>
  </div>
  <div class='section no-margin'>
    <div class='outline'>
      <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
        <a class="active" data-target="#legendDesc"><?php echo $lang->task->legendDesc?></a>
        <a data-target="#legendBasicInfo"><?php echo $lang->task->legendBasic?></a>
        <?php if(!empty($task->team)):?>
        <a data-target="#legendTeam"><?php echo $lang->task->team;?></a>
        <?php endif;?>
        <a data-target="#legendEffort"><?php echo $lang->task->legendEffort?></a>
        <a data-target="#legendLife"><?php echo $lang->task->legendLife?></a>
      </nav>
      <div>
        <div class="display in" id="legendDesc">
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->task->legendDesc;?></strong></div>
          </div>
          <div class='article'><?php echo $task->desc;?></div>
          <?php if($task->fromBug != 0):?>
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->bug->steps;?></strong></div>
          </div>
          <div class='article'><?php echo $task->bugSteps;?></div>
          <?php else:?>
          <?php if($task->storySpec or $task->storyFiles):?>
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->task->storySpec;?></strong></div>
          </div>
          <div class='article'>
            <?php echo $task->storySpec;?>
            <?php echo $this->fetch('file', 'printFiles', array('files' => $task->storyFiles, 'fieldset' => 'false'));?>
          </div>
          <?php endif;?>
          <?php if($task->storyVerify):?>
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->task->storyVerify;?></strong></div>
          </div>
          <div class='article'><?php echo $task->storyVerify;?></div>
          <?php endif;?>
          <?php endif;?>

          <?php if(isset($task->cases) and $task->cases):?>
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->task->case;?></strong></div>
          </div>
          <div class='article'>
            <ul class='list-unstyled'>
            <?php foreach($task->cases as $caseID => $case) echo '<li>' . html::a($this->createLink('testcase', 'view', "caseID=$caseID", '', true), "#$caseID " . $case, '', "data-toggle='modal' data-type='iframe' data-width='90%'") . '</li>';?>
            </ul>
          </div>
          <?php endif;?>

          <?php if(!empty($task->children)):?>
          <div class='content'>
            <table class='table table-hover table-fixed'>
              <thead>
                <tr class='text-center'>
                  <th><?php echo $lang->task->children;?></th>
                  <th class='w-80px'> <?php echo $lang->task->assignedTo;?></th>
                  <th class='w-80px'> <?php echo $lang->task->status;?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($task->children as $child):?>
                <tr class='text-center'>
                  <td class='text-left' title='<?php echo $child->name;?>'><a class="iframe" data-width="90%" href="<?php echo $this->createLink('task', 'view', "taskID=$child->id", '', true); ?>"><?php echo $child->name;?></a></td>
                  <td><?php if(isset($users[$child->assignedTo])) echo $users[$child->assignedTo];?></td>
                  <td><?php echo zget($lang->task->statusList, $child->status);?></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
          <?php endif;?>

          <?php echo $this->fetch('file', 'printFiles', array('files' => $task->files, 'fieldset' => 'true'));?>
          <?php include '../../common/view/m.action.html.php';?>
        </div>
        <div class="display hidden" id="legendBasicInfo">
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-80px'><?php echo $lang->task->project;?></th>
              <td><?php echo $project->name;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->task->module;?></th>
              <?php
              $moduleTitle = ''; 
              ob_start();
              if(empty($modulePath))
              {   
                  $moduleTitle .= '/';
                  echo "/";
              }   
              else
              {   
                  if($product)
                  {   
                      $moduleTitle .= $product->name . '/';
                      echo $product->name . $lang->arrow;
                  }   
                 foreach($modulePath as $key => $module)
                 {   
                     $moduleTitle .= $module->name;
                     echo $module->name;
                     if(isset($modulePath[$key + 1]))
                     {   
                         $moduleTitle .= '/';
                         echo $lang->arrow;
                     }   
                 }   
              }   
              $printModule = ob_get_contents();
              ob_end_clean();
              ?>
              <td><?php echo $printModule?></td>
            </tr>
            <tr>
              <th><?php echo $lang->task->story;?></th>
              <td>
              <?php 
              if($task->storyTitle and !common::printLink('story', 'view', "storyID=$task->story", $task->storyTitle, '', "class='iframe' data-width='80%'", true, true)) echo $task->storyTitle;
              if($task->needConfirm)
              {
                  echo "(<span class='warning'>{$lang->story->changed}</span> ";
                  echo html::a($this->createLink('task', 'confirmStoryChange', "taskID=$task->id"), $lang->confirm, 'hiddenwin');
                  echo ")";
              }
              ?>
              </td>
            </tr>
            <?php if($task->fromBug):?>
            <tr>
              <th><?php echo $lang->task->fromBug;?></th>
              <td><?php echo html::a($this->createLink('bug', 'view', "bugID=$task->fromBug"), "#$task->fromBug " . $fromBug->title, '_blank');?></td> 
            </tr>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->task->assignedTo;?></th>
              <td><?php echo $task->assignedTo ? $task->assignedToRealName . $lang->at . $task->assignedDate : '';?></td>
            </tr>
            <tr>
              <th><?php echo $lang->task->type;?></th>
              <td><?php echo $lang->task->typeList[$task->type];?></td>
            </tr>
            <tr>
              <th><?php echo $lang->task->status;?></th>
              <td><span class='label status-<?php echo $task->status;?>'><?php echo $lang->task->statusList[$task->status];?></span></td>
            </tr>
            <tr>
              <th><?php echo $lang->task->pri;?></th>
              <td><?php echo $lang->task->priList[$task->pri];?></td>
            </tr>
            <tr>
              <th><?php echo $lang->task->mailto;?></th>
              <td><?php $mailto = explode(',', str_replace(' ', '', $task->mailto)); foreach($mailto as $account) echo ' ' . zget($users, $account, $account); ?></td>
            </tr>
          </table>
        </div>

        <?php if(!empty($task->team)):?>
        <div class="display hidden" id="legendTeam">
          <table class='table bordered table-detail'>
            <thead>
            <tr>
              <th><?php echo $lang->task->team?></th>
              <th class='text-center'><?php echo $lang->task->estimate?></th>
              <th class='text-center'><?php echo $lang->task->consumed?></th>
              <th class='text-center'><?php echo $lang->task->left?></th>
            </tr>
            </thead>
            <?php foreach($task->team as $member):?>
            <tr class='text-center'>
              <td class='text-left'><?php echo zget($users, $member->account)?></td>
              <td><?php echo $member->estimate?></td>
              <td><?php echo $member->consumed?></td>
              <td><?php echo $member->left?></td>
            </tr>
            <?php endforeach;?>
          </table>
        </div>
        <?php endif;?>

        <div class="display hidden" id="legendEffort">
          <table class='table bordered table-detail'> 
            <tr>
              <th class='w-80px'><?php echo $lang->task->estStarted;?></th>
              <td><?php echo $task->estStarted;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->task->realStarted;?></th>
              <td><?php echo $task->realStarted; ?> </td>
            </tr>  
            <tr>
              <th><?php echo $lang->task->deadline;?></th>
              <td>
              <?php
              echo $task->deadline;
              if(isset($task->delay)) printf($lang->task->delayWarning, $task->delay);
              ?>
              </td>
            </tr>  
            <tr>
              <th><?php echo $lang->task->estimate;?></th>
              <td><?php echo $task->estimate . $lang->workingHour;?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->task->consumed;?></th>
              <td><?php echo round($task->consumed, 2) . $lang->workingHour;?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->task->left;?></th>
              <td><?php echo $task->left . $lang->workingHour;?></td>
            </tr>
          </table>
        </div>
        <div class="display hidden" id="legendLife">
          <table class='table bordered table-detail'>
            <tr>
              <td class='w-80px'><?php echo $lang->task->openedBy;?></td>
              <td><?php echo zget($users, $task->openedBy, $task->openedBy) . $lang->at . $task->openedDate;?></td>
            </tr>
            <?php if($task->finishedBy):?>
            <tr>
              <td><?php echo $lang->task->finishedBy;?></td>
              <td><?php echo zget($users, $task->finishedBy, $task->finishedBy) . $lang->at . $task->finishedDate;?></td>
            </tr>
            <?php endif;?>
            <?php if($task->canceledBy):?>
            <tr>
              <td><?php echo $lang->task->canceledBy;?></td>
              <td><?php echo zget($users, $task->canceledBy, $task->canceledBy) . $lang->at . $task->canceledDate;?></td>
            </tr>
            <?php endif;?>
            <?php if($task->closedBy):?>
            <tr>
              <td><?php echo $lang->task->closedBy;?></td>
              <td><?php echo zget($users, $task->closedBy, $task->closedBy) . $lang->at . $task->closedDate;?></td>
            </tr>
            <tr>
              <td><?php echo $lang->task->closedReason;?></td>
              <td><?php echo $lang->task->reasonList[$task->closedReason];?></td>
            </tr>
            <?php endif;?>
            <?php if($task->lastEditedBy):?>
            <tr>
              <td><?php echo $lang->task->lastEditedBy;?></td>
              <td><?php echo zget($users, $task->lastEditedBy, $task->lastEditedBy) . $lang->at . $task->lastEditedDate;?></td>
            </tr>
            <?php endif;?>
          </table>
        </div>
      </div>
    </div>
  </div>

  <nav class='nav nav-auto affix dock-bottom footer-actions'>
  <?php
  common::printIcon('task', 'assignTo',       "projectID={$task->project}&taskID={$task->id}", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->assignTo);
  common::printIcon('task', 'recordEstimate', "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->recordEstimate);
  common::printIcon('task', 'start',          "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->start);
  common::printIcon('task', 'restart',        "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->restart);
  common::printIcon('task', 'pause',          "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->pause);
  common::printIcon('task', 'finish',         "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->finish);
  common::printIcon('task', 'close',          "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->close);
  common::printIcon('task', 'activate',       "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->activate);
  common::printIcon('task', 'cancel',         "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->cancel);
  common::printIcon('task', 'edit',           "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->edit);
  if(empty($task->team) or empty($task->children)) common::printIcon('task', 'batchCreate', "project=$task->project&storyID=$task->story&moduleID=$task->module&taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->task->children);

  if(common::hasPriv('task', 'delete')) echo html::a($this->createLink('task', 'delete', "projectID=$task->project&taskID=$task->id"), $lang->delete, 'hiddenwin');
  if(common::hasPriv('action', 'comment', $task)) echo html::a('#commentBox', $lang->comment, '', "data-display data-backdrop='true'");
  ?>
  <a class='moreActionMenu hidden' data-display='dropdown' data-placement='beside-top'><?php echo $lang->more;?></a>
  <div id='moreActionMenu' class='list dropdown-menu'></div>
  </nav>
</div>

<div id='commentBox' class='enter-from-bottom hidden affix layer'>
  <div class='heading'>
    <div class='title'><?php echo $lang->comment;?></div>
    <nav class='nav'><a data-dismiss='display' class='muted'><i class='icon-remove'></i></a></nav>
  </div>
  <form id='commentForm' target='hiddenwin' class='has-padding' data-form-refresh='#history' method='post' action='<?php echo $this->createLink('action', 'comment', "objectType=task&objectID=$task->id")?>'>
    <div class='control'><?php echo html::textarea('comment', '',"rows='5' class='textarea' data-default-val");?></div>
    <div class='control'><button type='submit' class='btn primary'><?php echo $lang->save;?></button></div>
  </form>
</div>
<script>
function fixActionMenu()
{
    var winWidth = $(window).width();
    var width    = 0;
    $('.footer-actions a').each(function()
    {
        width += $(this).width();
    });

    if(width > winWidth)
    {
        $('.footer-actions a.moreActionMenu').removeClass('hidden');
        var lastNav = $('.footer-actions > a').not('.moreActionMenu').last();
        lastNav.addClass('item').css('display', lastNav.css('display'));
        $('#moreActionMenu').prepend("<div class='divider no-margin'></div>");
        $('#moreActionMenu').prepend(lastNav);

        fixActionMenu();
        $('.footer-actions > a').width(Math.floor(winWidth / $('.footer-actions > a').size()));
    }
}

$(function(){fixActionMenu();});
</script>
<?php include '../../common/view/m.footer.html.php';?>
