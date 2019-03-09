<?php
/**
 * The view mobile view file of testcase module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     testcase
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$bodyClass  = 'with-nav-bottom';
?>
<?php include '../../common/view/m.header.html.php';?>
<?php $browseLink  = $app->session->caseList != false ? $app->session->caseList : $this->createLink('testcase', 'browse', "productID=$case->product");?>
<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $case->id;?></strong></span>
      <strong style='color: <?php echo $case->color; ?>'><?php echo $case->title;?></strong>
      <?php if($case->version > 1):?>
      <select id='version'>
        <?php
        for($i = $case->version; $i >= 1; $i --)
        {
            $class = $i == $version ? " selected" : '';
            echo "<option value='$i'$class> #$i</option>";
        }
        ?>
      </select>
      <script>
      $('#version').change(function()
      {
          location.href = createLink('testcase', 'view', "caseID=<?php echo $case->id?>&version=" + $(this).val() + "&from=<?php echo $from;?>&taskID=<?php echo $taskID;?>");
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
        <a class="active" data-target="#legendView"><?php echo $lang->testcase->view?></a>
        <a data-target="#legendBasicInfo"><?php echo $lang->testcase->legendBasicInfo?></a>
      </nav>
      <div>
        <div class="display in" id="legendView">
          <div class='heading  gray'>
            <div class='title'><strong><?php echo $lang->testcase->precondition;?></strong></div>
          </div>
          <div class='article'><?php echo nl2br($case->precondition); ?></div>
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->testcase->steps;?></strong></div>
          </div>
          <div class='article'>
            <table class='table bordered compact' id='steps'>
              <thead>
                <tr>
                  <th class='w-50px'><?php echo $lang->testcase->stepID;?></th>
                  <th class='w-p70 text-left'><?php echo $lang->testcase->stepDesc;?></th>
                  <th class='text-left'><?php echo $lang->testcase->stepExpect;?></th>
                </tr>
              </thead>
              <?php
              $stepId = $childId = 0;
              foreach($case->steps as $stepID => $step)
              {
                  $stepClass = "step-{$step->type}";
                  if($step->type == 'group' or $step->type == 'step')
                  {
                      $stepId++;
                      $childId = 0;
                  }
                  if($step->type == 'step') $stepClass = 'step-group';
                  echo "<tr class='step {$stepClass}'>";
                  echo "<th class='step-id'>$stepId</th>";
                  echo "<td class='text-left'><div class='input-group'>";
                  if($step->type == 'item') echo "<span class='step-item-id'>{$stepId}.{$childId}</span>";
                  echo nl2br($step->desc) . "</td>";
                  echo "<td class='text-left'>" . nl2br($step->expect) . "</div></td>";
                  echo "</tr>";
                  $childId ++;
              }
              ?>
            </table>
          </div>
          <?php echo $this->fetch('file', 'printFiles', array('files' => $case->files, 'fieldset' => 'true'));?>
          <?php include '../../common/view/m.action.html.php';?>
        </div>
        <div class="display hidden" id="legendBasicInfo">
          <table class='table bordered table-detail'>
            <?php if($isLibCase):?>
            <tr>
              <th class='w-80px'><?php echo $lang->testcase->lib;?></th>
              <td><?php if(!common::printLink('testsuite', 'library', "libID=$case->lib", $libName)) echo $libName;?></td>
            </tr>
            <?php else:?>
            <tr>
              <th class='w-80px'><?php echo $lang->testcase->product;?></th>
              <td><?php if(!common::printLink('testcase', 'browse', "productID=$case->product", $productName)) echo $productName;?></td>
            </tr>
            <?php if($this->session->currentProductType != 'normal'):?>
            <tr>
              <th><?php echo $lang->product->branch;?></th>
              <td><?php if(!common::printLink('testcase', 'browse', "productID=$case->product&branch=$case->branch", $branchName)) echo $branchName;?></td>
            </tr>
            <?php endif;?>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->testcase->module;?></th>
              <td>
                <?php 
                if(empty($modulePath))
                {
                    echo "/";
                }
                else
                {
                   foreach($modulePath as $key => $module)
                   {
                       if(!common::printLink('testcase', 'browse', "productID=$case->product&branch=$module->branch&browseType=byModule&param=$module->id", $module->name)) echo $module->name;
                       if(isset($modulePath[$key + 1])) echo $lang->arrow;
                   }
                }
                ?>
              </td>
            </tr>
            <?php if(!$isLibCase):?>
            <tr class='nofixed'>
              <th><?php echo $lang->testcase->story;?></th>
              <td>
                <?php
                if(isset($case->storyTitle)) echo html::a($this->createLink('story', 'view', "storyID=$case->story"), "#$case->story:$case->storyTitle");
                if($case->story and $case->storyStatus == 'active' and $case->latestStoryVersion > $case->storyVersion)
                {
                    echo "(<span class='warning'>{$lang->story->changed}</span> ";
                    echo html::a($this->createLink('testcase', 'confirmStoryChange', "caseID=$case->id"), $lang->confirm, 'hiddenwin');
                    echo ")";
                }
                ?>
              </td>
            </tr>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->testcase->type;?></th>
              <td><?php echo $lang->testcase->typeList[$case->type];?></td>
            </tr>
            <tr>
              <th><?php echo $lang->testcase->stage;?></th>
              <td>
                <?php 
                if($case->stage)
                {
                    $stags = explode(',', $case->stage);
                    foreach($stags as $stage)
                    {
                        if(empty($stage)) continue;
                        isset($lang->testcase->stageList[$stage]) ? print($lang->testcase->stageList[$stage]) : print($stage);
                        echo "<br />";
                    }
                }
                ?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->testcase->pri;?></th>
              <td><span class='<?php echo 'pri' . zget($lang->testcase->priList, $case->pri);?>'><?php echo zget($lang->testcase->priList, $case->pri)?></span></td>
            </tr>
            <tr>
              <th><?php echo $lang->testcase->status;?></th>
              <td>
                <?php 
                echo $lang->testcase->statusList[$case->status];
                if($case->version > $case->currentVersion and $from == 'testtask')
                {
                    echo " (<span class='warning'>{$lang->testcase->changed}</span> ";
                    echo html::a($this->createLink('testcase', 'confirmchange', "caseID=$case->id"), $lang->confirm, 'hiddenwin');
                    echo ")";
                }
                ?>
              </td>
            </tr>
            <?php if(!$isLibCase):?>
             <tr>
              <th><?php echo $this->app->loadLang('testtask')->testtask->lastRunTime;?></th>
              <td><?php if(!helper::isZeroDate($case->lastRunDate)) echo $case->lastRunDate;?></td>
            </tr>
            <tr>
              <th><?php echo $this->app->loadLang('testtask')->testtask->lastRunResult;?></th>
              <td><?php if($case->lastRunResult) echo $lang->testcase->resultList[$case->lastRunResult];?></td>
            </tr>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->testcase->keywords;?></th>
              <td><?php echo $case->keywords;?></td>
            </tr>
            <?php if(!$isLibCase):?>
            <tr>
              <th><?php echo $lang->testcase->linkCase;?></th>
              <td>
                <?php
                if(isset($case->linkCaseTitles))
                {
                    foreach($case->linkCaseTitles as $linkCaseID => $linkCaseTitle)
                    {
                        echo html::a($this->createLink('testcase', 'view', "caseID=$linkCaseID"), "#$linkCaseID $linkCaseTitle", '_blank') . '<br />';
                    }
                }
                ?>
              </td>
            </tr>
            <?php endif;?>
            <?php if(!$isLibCase):?>
            <?php if($case->fromBug):?>
            <tr>
              <th><?php echo $lang->testcase->fromBug;?></th>
              <td><?php echo html::a($this->createLink('bug', 'view', "bugID=$case->fromBug"), $case->fromBugTitle);?></td>
            </tr>
            <?php endif;?>
            <?php if($case->toBugs):?>
            <tr>
              <th valign="top"><?php echo $lang->testcase->toBug;?></th>
              <td>
              <?php 
              foreach($case->toBugs as $bugID => $bugTitle) 
              {
                  echo '<p style="margin-bottom:0;">' . html::a($this->createLink('bug', 'view', "bugID=$bugID"), $bugTitle) . '</p>';
              }
              ?>
              </td>
            </tr>
            <?php endif;?>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->testcase->openedBy;?></th>
              <td><?php echo $users[$case->openedBy] . $lang->at . $case->openedDate;?></td>
            </tr>
            <?php if($config->testcase->needReview):?>
            <tr>
              <th><?php echo $lang->testcase->reviewedBy;?></th>
              <td><?php $reviewedBy = explode(',', $case->reviewedBy); foreach($reviewedBy as $account) echo ' ' . $users[trim($account)]; ?></td>
            </tr>
            <tr>
              <th><?php echo $lang->testcase->reviewedDate;?></th>
              <td><?php if($case->reviewedBy) echo $case->reviewedDate;?></td>
            </tr>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->testcase->lblLastEdited;?></th>
              <td><?php if($case->lastEditedBy) echo $users[$case->lastEditedBy] . $lang->at . $case->lastEditedDate;?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <nav class='nav nav-auto affix dock-bottom footer-actions'>
  <?php
  if($config->testcase->needReview) common::printIcon('testcase', 'review', "caseID=$case->id", $case, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->testcase->review);
  if(common::hasPriv('testcase', 'delete')) echo html::a($this->createLink('testcase', 'delete', "caseID=$case->id"), $lang->delete, 'hiddenwin');
  if(common::hasPriv('action', 'comment', $case)) echo html::a('#commentBox', $lang->comment, '', "data-display data-backdrop='true'");
  ?>
  </nav>
</div>

<div id='commentBox' class='enter-from-bottom hidden affix layer'>
  <div class='heading'>
    <div class="title"><?php echo $lang->comment;?></div>
    <nav class='nav'><a data-dismiss='display' class='muted'><i class='icon-remove'></i></a></nav>
  </div>
  <form id='commentForm' target='hiddenwin' class='has-padding' data-form-refresh='#history' method='post' action='<?php echo $this->createLink('action', 'comment',"objectType=case&objectID=$case->id")?>'>
    <div class='control'><?php echo html::textarea('comment', '',"rows='5' class='textarea' data-default-val");?></div>
    <div class='control'><button type='submit' class='btn primary'><?php echo $lang->save ?></button></div>
  </form>
</div>
<?php include '../../common/view/m.footer.html.php';?>
