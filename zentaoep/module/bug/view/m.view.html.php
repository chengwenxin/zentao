<?php
/**
 * The view mobile view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     bug
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$bodyClass  = 'with-nav-bottom';
?>
<?php include '../../common/view/m.header.html.php';?>
<?php $browseLink  = $app->session->bugList != false ? $app->session->bugList : inlink('browse', "productID=$bug->product");?>
<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $bug->id;?></strong></span>
      <strong style='color: <?php echo $bug->color; ?>'><?php echo $bug->title;?></strong>
    </div>
    <nav class='nav'>
      <a href='<?php echo $browseLink;?>' class='btn primary'><?php echo $lang->goback;?></a>
    </nav>
  </div>
  <div class='section no-margin'>
    <div class="outline">
      <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
        <a class="active" data-target="#legendView"><?php echo $lang->bug->view?></a>
        <a data-target="#legendBasicInfo"><?php echo $lang->bug->legendBasicInfo?></a>
        <a data-target="#legendLife"><?php echo $lang->bug->legendLife?></a>
        <a data-target="#legendRelated"><?php echo $lang->bug->legendRelated?></a>
      </nav>
      <div>
        <div class="display in" id="legendView">
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->bug->legendSteps;?></strong></div>
          </div>
          <div class='article'>
            <?php
            $tplStep = strip_tags(trim($lang->bug->tplStep));
            $steps   = str_replace('<p>' . $tplStep, '<p class="stepTitle">' . $tplStep . '</p><p>', $bug->steps);

            $tplResult = strip_tags(trim($lang->bug->tplResult));
            $steps     = str_replace('<p>' . $tplResult, '<p class="stepTitle">' . $tplResult . '</p><p>', $steps);

            $tplExpect = strip_tags(trim($lang->bug->tplExpect));
            $steps     = str_replace('<p>' . $tplExpect, '<p class="stepTitle">' . $tplExpect . '</p><p>', $steps);

            $steps = str_replace('<p></p>', '', $steps);
            echo $steps;
            ?>
          </div>
          <?php echo $this->fetch('file', 'printFiles', array('files' => $bug->files, 'fieldset' => 'true'));?>
          <?php include '../../common/view/m.action.html.php';?>
        </div>
        <div class="display hidden" id="legendBasicInfo">
          <table class='table bordered table-detail'>
            <tr valign='middle'>
              <th class='w-80px'><?php echo $lang->bug->product;?></th>
              <td><?php if(!common::printLink('bug', 'browse', "productID=$bug->product", $productName)) echo $productName;?></td>
            </tr>
            <?php if($this->session->currentProductType != 'normal'):?>
            <tr>
              <th><?php echo $lang->product->branch;?></th>
              <td><?php if(!common::printLink('bug', 'browse', "productID=$bug->product&branch=$bug->branch", $branchName)) echo $branchName;?></td>
            </tr>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->bug->module;?></th>
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
                 foreach($modulePath as $key => $module)
                 {
                     $moduleTitle .= $module->name;
                     if(!common::printLink('bug', 'browse', "productID=$bug->product&branch=$module->branch&browseType=byModule&param=$module->id", $module->name)) echo $module->name;
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
              <td title='<?php echo $moduleTitle?>'><?php echo $printModule?></td>
            </tr>
            <tr valign='middle'>
              <th><?php echo $lang->bug->productplan;?></th>
              <td><?php echo $bug->planName;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->type;?></th>
              <td><?php if(isset($lang->bug->typeList[$bug->type])) echo $lang->bug->typeList[$bug->type]; else echo $bug->type;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->severity;?></th>
              <td><span class='<?php echo 'severity' . zget($lang->bug->severityList, $bug->severity);?>'><?php echo zget($lang->bug->severityList, $bug->severity)?></span></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->pri;?></th>
              <td><span class='<?php echo 'pri' . zget($lang->bug->priList, $bug->pri);?>'><?php echo zget($lang->bug->priList, $bug->pri)?></span></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->status;?></th>
              <td class='bug-<?php echo $bug->status?>'><strong><?php echo $lang->bug->statusList[$bug->status];?></strong></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->activatedCount;?></th>
              <td><?php echo $bug->activatedCount;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->confirmed;?></th>
              <td><?php echo $lang->bug->confirmedList[$bug->confirmed];?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->lblAssignedTo;?></th>
              <td><?php if($bug->assignedTo) echo $users[$bug->assignedTo] . $lang->at . $bug->assignedDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->deadline;?></th>
              <td><?php if($bug->deadline) echo  $bug->deadline;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->os;?></th>
              <td><?php echo $lang->bug->osList[$bug->os];?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->browser;?></th>
              <td><?php echo $lang->bug->browserList[$bug->browser];?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->keywords;?></th>
              <td><?php echo $bug->keywords;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->mailto;?></th>
              <td><?php $mailto = explode(',', str_replace(' ', '', $bug->mailto)); foreach($mailto as $account) echo ' ' . $users[$account]; ?></td>
            </tr>
          </table>
        </div>
        <div class="display hidden" id="legendLife">
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-80px'><?php echo $lang->bug->openedBy;?></th>
              <td> <?php echo $users[$bug->openedBy] . $lang->at . $bug->openedDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->openedBuild;?></th>
              <td>
                <?php
                if($bug->openedBuild)
                {
                    $openedBuilds = explode(',', $bug->openedBuild);
                    foreach($openedBuilds as $openedBuild) isset($builds[$openedBuild]) ? print($builds[$openedBuild] . '<br />') : print($openedBuild . '<br />');
                }
                else
                {
                    echo $bug->openedBuild;
                }
                ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->lblResolved;?></th>
              <td><?php if($bug->resolvedBy) echo $users[$bug->resolvedBy] . $lang->at . $bug->resolvedDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->resolvedBuild;?></th>
              <td><?php  echo zget($builds, $bug->resolvedBuild);?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->resolution;?></th>
              <td>
                <?php
                echo $lang->bug->resolutionList[$bug->resolution];
                if(isset($bug->duplicateBugTitle)) echo " #$bug->duplicateBug:" . html::a($this->createLink('bug', 'view', "bugID=$bug->duplicateBug"), $bug->duplicateBugTitle);
                ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->closedBy;?></th>
              <td><?php if($bug->closedBy) echo $users[$bug->closedBy] . $lang->at . $bug->closedDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->lblLastEdited;?></th>
              <td><?php if($bug->lastEditedBy) echo zget($users, $bug->lastEditedBy, $bug->lastEditedBy) . $lang->at . $bug->lastEditedDate?></td>
            </tr>
          </table>
        </div>
        <div class="display hidden" id="legendRelated">
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-80px'><?php echo $lang->bug->project;?></th>
              <td><?php if($bug->project) echo html::a($this->createLink('project', 'browse', "projectid=$bug->project"), $bug->projectName);?></td>
            </tr>
            <tr class='nofixed'>
              <th><?php echo $lang->bug->story;?></th>
              <td>
                <?php
                if($bug->story) echo html::a($this->createLink('story', 'view', "storyID=$bug->story"), "#$bug->story $bug->storyTitle");
                if($bug->storyStatus == 'active' and $bug->latestStoryVersion > $bug->storyVersion)
                {
                    echo "(<span class='warning'>{$lang->story->changed}</span> ";
                    echo html::a($this->createLink('bug', 'confirmStoryChange', "bugID=$bug->id"), $lang->confirm, 'hiddenwin');
                    echo ")";
                }
                ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->bug->task;?></th>
              <td><?php if($bug->task) echo html::a($this->createLink('task', 'view', "taskID=$bug->task"), $bug->taskName);?></td>
            </tr>
            <tr class='text-top'>
              <th class='w-80px'><?php echo $lang->bug->linkBug;?></th>
              <td>
                <?php
                if(isset($bug->linkBugTitles))
                {
                    foreach($bug->linkBugTitles as $linkBugID => $linkBugTitle)
                    {
                        echo html::a($this->createLink('bug', 'view', "bugID=$linkBugID"), "#$linkBugID $linkBugTitle", '_blank') . '<br />';
                    }
                }
                ?>
              </td>
            </tr>
            <?php if($bug->case):?>
            <tr>
              <th class='w-60px'><?php echo $lang->bug->fromCase;?></th>
              <td><?php echo html::a($this->createLink('testcase', 'view', "caseID=$bug->case"), "#$bug->case $bug->caseTitle", '_blank');?></td>
            </tr>
            <?php endif;?>
            <?php if($bug->toCases):?>
            <tr>
              <th><?php echo $lang->bug->toCase;?></th>
              <td>
              <?php 
              foreach($bug->toCases as $caseID => $case) 
              {
                  echo '<p style="margin-bottom:0;">' . html::a($this->createLink('testcase', 'view', "caseID=$caseID"), $case) . '</p>';
              }
              ?>
              </td>
            </tr>
            <?php endif;?>
            <?php if($bug->toStory != 0):?>
            <tr>
              <th><?php echo $lang->bug->toStory;?></th>
              <td><?php echo html::a($this->createLink('story', 'view', "storyID=$bug->toStory"), "#$bug->toStory $bug->toStoryTitle", '_blank');?></td>
            </tr>
            <?php endif;?>
            <?php if($bug->toTask != 0):?>
            <tr>
              <th><?php echo $lang->bug->toTask;?></th>
              <td><?php echo html::a($this->createLink('task', 'view', "taskID=$bug->toTask"), "#$bug->toTask $bug->toTaskTitle", '_blank');?></td>
            </tr>
            <?php endif;?>
          </table>
        </div>
      </div>
    </div>
  </div>

  <nav class='nav nav-auto affix dock-bottom footer-actions'>
  <?php
  common::printIcon('bug', 'confirmBug',    "bugID=$bug->id", $bug, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->bug->confirmBug);
  common::printIcon('bug', 'assignTo',    "bugID=$bug->id", $bug, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->bug->assignTo);
  common::printIcon('bug', 'resolve',     "bugID=$bug->id", $bug, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->bug->resolve);
  common::printIcon('bug', 'close',  "bugID=$bug->id", $bug, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->bug->close);
  common::printIcon('bug', 'activate',  "bugID=$bug->id", $bug, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->bug->activate);
  common::printIcon('bug', 'toStory',  "product=$bug->product&branch=$bug->branch&module=0&story=0&project=0&bugID=$bug->id", $bug, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->bug->toStory);
  common::printIcon('bug', 'edit',   "bugID=$bug->id", $bug, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->edit);
  if(common::hasPriv('bug', 'delete')) echo html::a($this->createLink('bug', 'delete', "bugID=$bug->id"), $lang->delete, 'hiddenwin');
  if(common::hasPriv('action', 'comment', $bug)) echo html::a('#commentBox', $lang->comment, '', "data-display data-backdrop='true'");
  ?>
  </nav>
</div>

<div id='commentBox' class='enter-from-bottom hidden affix layer'>
  <div class='heading'>
    <div class="title"><?php echo $lang->comment;?></div>
    <nav class='nav'><a data-dismiss='display' class='muted'><i class='icon-remove'></i></a></nav>
  </div>
  <form id='commentForm' target='hiddenwin' class='has-padding' data-form-refresh='#history' method='post' action='<?php echo $this->createLink('action', 'comment',"objectType=bug&objectID=$bug->id")?>'>
    <div class='control'><?php echo html::textarea('comment', '',"rows='5' class='textarea' data-default-val");?></div>
    <div class='control'><button type='submit' class='btn primary'><?php echo $lang->save ?></button></div>
  </form>
</div>
<?php include '../../common/view/m.footer.html.php';?>
