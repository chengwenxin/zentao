<?php
/**
 * The view mobile file of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     story
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$bodyClass  = 'with-nav-bottom';
?>
<?php include '../../common/view/m.header.html.php';?>
<?php $browseLink  = $app->session->storyList != false ? $app->session->storyList : $this->createLink('product', 'browse', "productID=$story->product&branch=$story->branch&moduleID=$story->module");?>
<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $story->id;?></strong></span>
      <strong style='color: <?php echo $story->color; ?>'><?php echo $story->title;?></strong>
      <?php if($story->version > 1):?>
      <select id='version'>
        <?php
        for($i = $story->version; $i >= 1; $i --)
        {
            $class = $i == $version ? " selected" : '';
            echo "<option value='$i'$class> #$i</option>";
        }
        ?>
      </select>
      <script>
      $('#version').change(function()
      {
          location.href = createLink('story', 'view', "storyID=<?php echo $story->id?>&version=" + $(this).val());
      });
      </script>
      <?php endif; ?>

    </div>
    <nav class='nav'>
      <a href='<?php echo $browseLink;?>' class='btn primary'><?php echo $lang->goback;?></a>
    </nav>
  </div>
  <div class='section no-margin'>
    <div class="outline">
      <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
        <a class="active" data-target="#legendView"><?php echo $lang->story->view?></a>
        <a data-target="#legendBasicInfo"><?php echo $lang->story->legendBasicInfo?></a>
        <a data-target="#legendLifeTime"><?php echo $lang->story->legendLifeTime?></a>
        <a data-target="#legendRelated"><?php echo $lang->story->legendRelated?></a>
      </nav>
      <div>
        <div class="display in" id="legendView">
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->story->legendSpec;?></strong></div>
          </div>
          <div class='article'><?php echo $story->spec;?></div>
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->story->legendVerify;?></strong></div>
          </div>
          <div class='article'><?php echo $story->verify;?></div>
          <?php echo $this->fetch('file', 'printFiles', array('files' => $story->files, 'fieldset' => 'true'));?>
          <?php include '../../common/view/m.action.html.php';?>
        </div>
        <div class="display hidden" id="legendBasicInfo">
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-80px'><?php echo $lang->story->product;?></th>
              <td><?php common::printLink('product', 'view', "productID=$story->product", $product->name);?></td>
            </tr>
            <?php if($product->type != 'normal'):?>
            <tr>
              <th><?php echo $lang->product->branch;?></th>
              <td><?php common::printLink('product', 'browse', "productID=$story->product&branch=$story->branch", $branches[$story->branch]);?></td>
            </tr>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->story->module;?></th>
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
                      if(!common::printLink('product', 'browse', "productID=$story->product&branch=$story->branch&browseType=byModule&param=$module->id", $module->name)) echo $module->name;
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
              <th><?php echo $lang->story->plan;?></th>
              <td>
              <?php
              if(isset($story->planTitle))
              {
                  foreach($story->planTitle as $planID => $planTitle)
                  {
                      if(!common::printLink('productplan', 'view', "planID=$planID", $planTitle)) echo $lanTitle;
                      echo '<br />';
                  }
              }
              ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->story->source;?></th>
              <td id='source'><?php echo $lang->story->sourceList[$story->source] . ' ' . $story->sourceNote;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->status;?></th>
              <td class='story-<?php echo $story->status?>'><?php echo $lang->story->statusList[$story->status];?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->stage;?></th>
              <td>
              <?php
              if($story->stages and $branches)
              {
                  foreach($story->stages as $branch => $stage) if(isset($branches[$branch])) echo $branches[$branch] . ' : ' . $lang->story->stageList[$stage] . '<br />';
              }
              else
              {
                  echo $lang->story->stageList[$story->stage];
              }
              ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->story->pri;?></th>
              <td><span class='<?php echo 'pri' . zget($lang->story->priList, $story->pri);?>'><?php echo zget($lang->story->priList, $story->pri)?></span></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->estimate;?></th>
              <td><?php echo $story->estimate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->keywords;?></th>
              <td><?php echo $story->keywords;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->legendMailto;?></th>
              <td><?php $mailto = explode(',', $story->mailto); foreach($mailto as $account) {if(empty($account)) continue; echo "<span>" . $users[trim($account)] . '</span> &nbsp;'; }?></td>
            </tr>
          </table>
        </div>
        <div class="display hidden" id="legendLifeTime">
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-80px'><?php echo $lang->story->openedBy;?></th>
              <td><?php echo $users[$story->openedBy] . $lang->at . $story->openedDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->assignedTo;?></th>
              <td><?php if($story->assignedTo) echo $users[$story->assignedTo] . $lang->at . $story->assignedDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->reviewedBy;?></th>
              <td><?php $reviewedBy = explode(',', $story->reviewedBy); foreach($reviewedBy as $account) echo ' ' . $users[trim($account)]; ?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->reviewedDate;?></th>
              <td><?php if($story->reviewedBy) echo $story->reviewedDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->closedBy;?></th>
              <td><?php if($story->closedBy) echo $users[$story->closedBy] . $lang->at . $story->closedDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->closedReason;?></th>
              <td>
                <?php
                if($story->closedReason) echo $lang->story->reasonList[$story->closedReason];
                if(isset($story->extraStories[$story->duplicateStory]))
                {
                    echo html::a(inlink('view', "storyID=$story->duplicateStory"), '#' . $story->duplicateStory . ' ' . $story->extraStories[$story->duplicateStory]);
                }
                ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->story->lastEditedBy;?></th>
              <td><?php if($story->lastEditedBy) echo $users[$story->lastEditedBy] . $lang->at . $story->lastEditedDate;?></td>
            </tr>
          </table>
        </div>
        <div class="display hidden" id="legendRelated">
          <table class='table bordered table-detail'>
            <tr class='text-top'>
              <th class='w-80px'><?php echo $lang->story->legendProjectAndTask?></th>
              <td class='pd-0'>
                <ul class='list-unstyled'>
                <?php
                foreach($story->tasks as $projectTasks)
                {
                    foreach($projectTasks as $task)
                    {
                        if(!isset($projects[$task->project])) continue;
                        $projectName = $projects[$task->project];
                        echo "<li title='$task->name'>" . html::a($this->createLink('task', 'view', "taskID=$task->id", '', true), "#$task->id $task->name", '', "class='iframe' data-width='80%'");
                        echo html::a($this->createLink('project', 'browse', "projectID=$task->project"), $projectName, '', "class='text-muted'") . '</li>';
                    }
                }
                if(count($story->tasks) == 0)
                {
                    foreach($story->projects as $project) echo "<li title='$project->name'>" . $project->name . '</li>';
                }
                ?>
                </ul>
              </td>
            </tr>
            <?php if(!empty($fromBug)):?>
            <tr class='text-top'>
              <th class='w-80px'><?php echo $lang->story->legendFromBug;?></th>
              <td class='pd-0'>
                <ul class='list-unstyled'>
                <?php echo "<li title='#$fromBug->id $fromBug->title'>" . html::a($this->createLink('bug', 'view', "bugID=$fromBug->id"), "#$fromBug->id $fromBug->title") . '</li>';?>
                </ul>
              </td>
            </tr>
            <?php endif;?>
            <tr class='text-top'>
              <th class='w-80px'><?php echo $lang->story->legendBugs;?></th>
              <td class='pd-0'>
                <ul class='list-unstyled'>
                <?php
                foreach($bugs as $bug)
                {
                    echo "<li title='#$bug->id $bug->title'>" . html::a($this->createLink('bug', 'view', "bugID=$bug->id"), "#$bug->id $bug->title") . '</li>';
                }
                ?>
                </ul>
              </td>
            </tr>
            <tr class='text-top'>
              <th><?php echo $lang->story->legendCases;?></th>
              <td class='pd-0'>
                <ul class='list-unstyled'>
                <?php
                foreach($cases as $case)
                {
                    echo "<li title='#$case->id $case->title'>" . html::a($this->createLink('testcase', 'view', "caseID=$case->id"), "#$case->id $case->title") . '</li>';
                }
                ?>
                </ul>
              </td>
            </tr>
            <tr class='text-top'>
              <th><?php echo $lang->story->legendLinkStories;?></th>
              <td class='pd-0'>
                <ul class='list-unstyled'>
                  <?php
                  $linkStories = explode(',', $story->linkStories) ;    
                  foreach($linkStories as $linkStoryID)
                  {
                      if(isset($story->extraStories[$linkStoryID])) echo '<li>' . html::a(inlink('view', "storyID=$linkStoryID"), "#$linkStoryID " . $story->extraStories[$linkStoryID]) . '</li>';
                  }
                  ?>
                </ul>
              </td>
            </tr>
            <tr class='text-top'>
              <th><?php echo $lang->story->legendChildStories;?></th>
              <td class='pd-0'>
                <ul class='list-unstyled'>
                  <?php
                  $childStories = explode(',', $story->childStories) ;    
                  foreach($childStories as $childStoryID)
                  {
                    if(isset($story->extraStories[$childStoryID])) echo '<li>' . html::a(inlink('view', "storyID=$childStoryID"), "#$childStoryID " . $story->extraStories[$childStoryID]) . '</li>';
                  }
                  ?>
                </ul>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <nav class='nav nav-auto affix dock-bottom footer-actions'>
  <?php
  common::printIcon('story', 'change',    "storyID=$story->id", $story, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->story->change);
  common::printIcon('story', 'close',     "storyID=$story->id", $story, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->story->close);
  common::printIcon('story', 'activate',  "storyID=$story->id", $story, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->story->activate);
  if($from == 'project') common::printIcon('task', 'create',   "project=$param&storyID=$story->id&moduleID=$story->module", $story, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'");
  common::printIcon('story', 'edit',   "storyID=$story->id", $story, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->edit);
  if(common::hasPriv('story', 'delete')) echo html::a($this->createLink('story', 'delete', "storyID=$story->id"), $lang->delete, 'hiddenwin');
  if(common::hasPriv('action', 'comment', $story)) echo html::a('#commentBox', $lang->comment, '', "data-display data-backdrop='true'");
  ?>
  </nav>
</div>

<div id='commentBox' class='enter-from-bottom hidden affix layer'>
  <div class='heading'>
    <div class="title"><?php echo $lang->comment;?></div>
    <nav class='nav'><a data-dismiss='display' class='muted'><i class='icon-remove'></i></a></nav>
  </div>
  <form id='commentForm' target='hiddenwin' class='has-padding' data-form-refresh='#history' method='post' action='<?php echo $this->createLink('action', 'comment',"objectType=story&objectID=$story->id")?>'>
    <div class='control'><?php echo html::textarea('comment', '',"rows='5' class='textarea' data-default-val");?></div>
    <div class='control'><button type='submit' class='btn primary'><?php echo $lang->save ?></button></div>
  </form>
</div>
<?php include '../../common/view/m.footer.html.php';?>
