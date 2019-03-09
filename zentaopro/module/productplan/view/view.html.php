<?php
/**
 * The view of productplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     productplan
 * @version     $Id: view.html.php 5096 2013-07-11 07:02:43Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/sortable.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<?php js::set('confirmUnlinkStory', $lang->productplan->confirmUnlinkStory)?>
<?php js::set('confirmUnlinkBug', $lang->productplan->confirmUnlinkBug)?>
<?php js::set('planID', $plan->id);?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'>
    <?php $browseLink = $this->session->productPlanList ? $this->session->productPlanList : inlink('browse', "planID=$plan->id");?>
    <?php common::printBack($browseLink, 'btn btn-primary');?>
    <div class='divider'></div>
    <div class='page-title'>
      <span class='label label-id'><?php echo $plan->id;?></span>
      <span title='<?php echo $plan->title;?>' class='text'><?php echo $plan->title;?></span>
      <?php if($product->type !== 'normal') echo "<span title='{$lang->product->branchName[$product->type]}' class='label label-branch label-badge'>" . $branches[$branch] . '</span>';?>
      <span class='label label-info label-badge'>
        <?php echo ($plan->begin == '2030-01-01' || $plan->end == '2030-01-01') ? $lang->productplan->future : $plan->begin . '~' . $plan->end;?>
      </span>
      <?php if($plan->deleted):?>
      <span class='label label-danger'><?php echo $lang->product->deleted;?></span>
      <?php endif; ?>
    </div>
  </div>
  <div class='btn-toolbar pull-right'>
    <?php
    if(!$plan->deleted)
    {
        echo "<div class='btn-group' id='createActionMenu'>";
        $batchMisc = common::hasPriv('story', 'batchCreate') ? 'btn btn-link' : "disabled";
        $batchLink = common::hasPriv('story', 'batchCreate') ?  $this->createLink('story', 'batchCreate', "productID=$plan->product&branch=$plan->branch&moduleID=0&story=0&project=0&plan={$plan->id}") : '#';
        echo html::a($batchLink, "<i class='icon icon-plus'></i><span class='text'>" . $lang->story->batchCreate . '</span>', '', "class='$batchMisc'");
        common::printIcon('story', 'create', "productID=$plan->product&branch=$plan->branch&moduleID=0&storyID=0&projectID=0&bugID=0&planID=$plan->id", $plan, 'button', 'plus');
        echo "</div>";

        if(common::hasPriv('productplan', 'linkStory'))
        {
          echo html::a(inlink('view', "planID=$plan->id&type=story&orderBy=id_desc&link=true"), '<i class="icon-link"></i> ' . $lang->productplan->linkStory, '', "class='btn btn-link'");
        }
        if(common::hasPriv('productplan', 'linkBug') and $config->global->flow != 'onlyStory')
        {
            echo html::a(inlink('view', "planID=$plan->id&type=bug&orderBy=id_desc&link=true"), '<i class="icon-bug"></i> ' . $lang->productplan->linkBug, '', "class='btn btn-link'");
        }
        common::printIcon('productplan', 'edit',   "planID=$plan->id", $plan);
        common::printIcon('productplan', 'delete', "planID=$plan->id", $plan, 'button', '', 'hiddenwin');
    }
    ?>
  </div>
</div>
<div id='mainContent' class='main-content'>
  <div class='tabs' id='tabsNav'>
    <ul class='nav nav-tabs'>
      <li class='<?php if($type == 'story') echo 'active'?>'><a href='#stories' data-toggle='tab'><?php echo  html::icon($lang->icons['story'], 'text-primary') . ' ' . $lang->productplan->linkedStories;?></a></li>
      <?php if($config->global->flow != 'onlyStory'):?>
      <li class='<?php if($type == 'bug') echo 'active'?>'><a href='#bugs' data-toggle='tab'><?php echo  html::icon($lang->icons['bug'], 'text-red') . ' ' . $lang->productplan->linkedBugs;?></a></li>
      <?php endif;?>
      <li><a href='#planInfo' data-toggle='tab'><?php echo  html::icon($lang->icons['plan'], 'text-info') . ' ' . $lang->productplan->view;?></a></li>
    </ul>
    <div class='tab-content'>
      <div id='stories' class='tab-pane <?php if($type == 'story') echo 'active'?>'>
        <?php $canOrder = common::hasPriv('project', 'storySort');?>
        <?php if(common::hasPriv('productplan', 'linkStory')):?>
        <div class='actions'>
        <?php echo html::a("javascript:showLink($plan->id, \"story\")", '<i class="icon-link"></i> ' . $lang->productplan->linkStory, '', "class='btn btn-primary'");?>
        </div>
        <div class='linkBox cell hidden'></div>
        <?php endif;?>
        <form class='main-table table-story' data-ride='table' method='post' target='hiddenwin' action="<?php echo inlink('batchUnlinkStory', "planID=$plan->id&orderBy=$orderBy");?>">
          <table class='table has-sort-head' id='storyList'>
            <?php
            $canBatchUnlink       = common::hasPriv('productPlan', 'batchUnlinkStory');
            $canBatchClose        = common::hasPriv('story', 'batchClose');
            $canBatchEdit         = common::hasPriv('story', 'batchEdit');
            $canBatchReview       = common::hasPriv('story', 'batchReview');
            $canBatchChangeBranch = common::hasPriv('story', 'batchChangeBranch');
            $canBatchChangeModule = common::hasPriv('story', 'batchChangeModule');
            $canBatchChangePlan   = common::hasPriv('story', 'batchChangePlan');
            $canBatchChangeStage  = common::hasPriv('story', 'batchChangeStage');
            $canBatchAssignTo     = common::hasPriv('story', 'batchAssignTo');

            $canBatchAction = $canBatchUnlink or $canBatchClose or $canBatchEdit or $canBatchReview or $canBatchChangeBranch or $canBatchChangeModule or $canBatchChangePlan or $canBatchChangeStage or $canBatchAssignTo;
            $vars = "planID={$plan->id}&type=story&orderBy=%s&link=$link&param=$param";
            ?>
            <thead>
              <tr class='text-center'>
                <th class='c-id text-left'>
                  <?php if($planStories && $canBatchAction):?>
                  <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
                    <label></label>
                  </div>
                  <?php endif;?>
                  <?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?>
                </th>
                <?php if($canOrder):?>
                <th class='w-70px'><?php common::printOrderLink('order', $orderBy, $vars, $lang->productplan->updateOrder);?></th>
                <?php endif;?>
                <th class='w-70px'> <?php common::printOrderLink('pri',        $orderBy, $vars, $lang->priAB);?></th>
                <th class='w-150px text-left'><?php common::printOrderLink('module',     $orderBy, $vars, $lang->story->module);?></th>
                <th class='text-left'><?php common::printOrderLink('title',      $orderBy, $vars, $lang->story->title);?></th>
                <th class='c-user'> <?php common::printOrderLink('openedBy',   $orderBy, $vars, $lang->openedByAB);?></th>
                <th class='c-user'> <?php common::printOrderLink('assignedTo', $orderBy, $vars, $lang->assignedToAB);?></th>
                <th class='w-70px'> <?php common::printOrderLink('estimate',   $orderBy, $vars, $lang->story->estimateAB);?></th>
                <th class='w-70px'> <?php common::printOrderLink('status',     $orderBy, $vars, $lang->statusAB);?></th>
                <th class='w-80px'> <?php common::printOrderLink('stage',      $orderBy, $vars, $lang->story->stageAB);?></th>
                <th class='c-actions-1'> <?php echo $lang->actions?></th>
              </tr>
            </thead>
            <tbody class='sortable text-center'>
              <?php
              $totalEstimate = 0.0;
              ?>
              <?php foreach($planStories as $story):?>
              <?php
              $viewLink = $this->createLink('story', 'view', "storyID=$story->id");
              $totalEstimate += $story->estimate;
              ?>
              <tr data-id='<?php echo $story->id;?>'>
                <td class='c-id text-left'>
                  <?php if($canBatchAction):?>
                  <?php echo html::checkbox('storyIDList', array($story->id => sprintf('%03d', $story->id)));?>
                  <?php else:?>
                  <?php printf('%03d', $story->id);?>
                  <?php endif;?>
                </td>
                <?php if($canOrder):?><td class='sort-handler'><i class='icon-move'></i></td><?php endif;?>
                <td><span class='label-pri <?php echo 'label-pri-' . $story->pri;?>' title='<?php echo zget($lang->story->priList, $story->pri, $story->pri);?>'><?php echo zget($lang->story->priList, $story->pri, $story->pri);?></span></td>
                <td class='text-left nobr'><?php echo zget($modulePairs, $story->module, '');?></td>
                <td class='text-left nobr' title='<?php echo $story->title?>'><?php echo html::a($viewLink , $story->title);?></td>
                <td><?php echo zget($users, $story->openedBy);?></td>
                <td><?php echo zget($users, $story->assignedTo);?></td>
                <td><?php echo $story->estimate;?></td>
                <td>
                  <span class='status-story status-<?php echo $story->status?>'>
                    <?php echo $lang->story->statusList[$story->status];?>
                  </span>
                </td>
                <td><?php echo $lang->story->stageList[$story->stage];?></td>
                <td class='c-actions'>
                  <?php
                  if(common::hasPriv('productplan', 'unlinkStory'))
                  {
                      $unlinkURL = $this->createLink('productplan', 'unlinkStory', "story=$story->id&plan=$plan->id&confirm=yes");
                      echo html::a("javascript:ajaxDelete(\"$unlinkURL\",\"storyList\",confirmUnlinkStory)", '<i class="icon-unlink"></i>', '', "class='btn' title='{$lang->productplan->unlinkStory}'");
                  }
                  ?>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <?php if($planStories):?>
          <div class='table-footer'>
            <?php if($canBatchAction):?>
            <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
            <div class='table-actions btn-toolbar'>
              <?php $actionLink = inlink('batchUnlinkStory', "planID=$plan->id&orderBy=$orderBy");?>
              <div class='btn-group dropup'>
                <?php echo html::commonButton($lang->productplan->unlinkStory, ($canBatchUnlink ? '' : 'disabled') . "onclick=\"setFormAction('$actionLink', 'hiddenwin', this)\"");?>
                <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>
                <ul class='dropdown-menu'>
                  <?php
                  $class = "class='disabled'";

                  $actionLink = $this->createLink('story', 'batchClose', "productID=$plan->product");
                  $misc = $canBatchClose ? "onclick=\"setFormAction('$actionLink', '', this)\"" : $class;
                  echo "<li>" . html::a('#', $lang->close, '', $misc) . "</li>";

                  $actionLink = $this->createLink('story', 'batchEdit', "productID=$plan->product&projectID=0&branch=$branch");
                  $misc = $canBatchEdit ? "onclick=\"setFormAction('$actionLink', '', this)\"" : $class;
                  echo "<li>" . html::a('#', $lang->edit, '', $misc) . "</li>";

                  if($canBatchReview)
                  {
                      echo "<li class='dropdown-submenu'>";
                      echo html::a('javascript:;', $lang->story->review, '', "id='reviewItem'");
                      echo "<ul class='dropdown-menu'>";
                      unset($lang->story->reviewResultList['']);
                      unset($lang->story->reviewResultList['revert']);
                      foreach($lang->story->reviewResultList as $key => $result)
                      {
                          $actionLink = $this->createLink('story', 'batchReview', "result=$key");
                          if($key == 'reject')
                          {
                              echo "<li class='dropdown-submenu'>";
                              echo html::a('#', $result, '', "id='rejectItem'");
                              echo "<ul class='dropdown-menu'>";
                              unset($lang->story->reasonList['']);
                              unset($lang->story->reasonList['subdivided']);
                              unset($lang->story->reasonList['duplicate']);

                              foreach($lang->story->reasonList as $key => $reason)
                              {
                                  $actionLink = $this->createLink('story', 'batchReview', "result=reject&reason=$key");
                                  echo "<li>";
                                  echo html::a('#', $reason, '', "onclick=\"setFormAction('$actionLink','hiddenwin', this)\"");
                                  echo "</li>";
                              }
                              echo '</ul></li>';
                          }
                          else
                          {
                            echo '<li>' . html::a('#', $result, '', "onclick=\"setFormAction('$actionLink','hiddenwin', this)\"") . '</li>';
                          }
                      }
                      echo '</ul></li>';
                  }
                  else
                  {
                      echo '<li>' . html::a('javascript:;', $lang->story->review,  '', $class) . '</li>';
                  }

                  if($canBatchChangeBranch and $this->session->currentProductType != 'normal')
                  {
                      $withSearch = count($branches) > 8;
                      echo "<li class='dropdown-submenu'>";
                      echo html::a('javascript:;', $lang->product->branchName[$this->session->currentProductType], '', "id='branchItem'");
                      echo "<div class='dropdown-menu" . ($withSearch ? ' with-search':'') . "'>";
                      echo '<ul class="dropdown-list">';
                      foreach($branches as $branchID => $branchName)
                      {
                          $actionLink = $this->createLink('story', 'batchChangeBranch', "branchID=$branchID");
                          echo "<li class='option' data-key='$branchID'>" . html::a('#', $branchName, '', "onclick=\"setFormAction('$actionLink', 'hiddenwin', this)\"") . "</li>";
                      }
                      echo '</ul>';
                      if($withSearch) echo "<div class='menu-search'><div class='input-group input-group-sm'><input type='text' class='form-control' placeholder=''><span class='input-group-addon'><i class='icon-search'></i></span></div></div>";
                      echo '</div></li>';
                  }

                  if($canBatchChangeModule)
                  {
                      $withSearch = count($modules) > 8;
                      echo "<li class='dropdown-submenu'>";
                      echo html::a('javascript:;', $lang->story->moduleAB, '', "id='moduleItem'");
                      echo "<div class='dropdown-menu" . ($withSearch ? ' with-search':'') . "'>";
                      echo '<ul class="dropdown-list">';
                      foreach($modules as $moduleId => $module)
                      {
                          $actionLink = $this->createLink('story', 'batchChangeModule', "moduleID=$moduleId");
                          echo "<li class='option' data-key='$moduleId'>" . html::a('#', $module, '', "onclick=\"setFormAction('$actionLink','hiddenwin', this)\"") . "</li>";
                      }
                      echo '</ul>';
                      if($withSearch) echo "<div class='menu-search'><div class='input-group input-group-sm'><input type='text' class='form-control' placeholder=''><span class='input-group-addon'><i class='icon-search'></i></span></div></div>";
                      echo '</div></li>';
                  }
                  else
                  {
                      echo '<li>' . html::a('javascript:;', $lang->story->moduleAB, '', $class) . '</li>';
                  }

                  if($canBatchChangePlan)
                  {
                      unset($plans['']);
                      unset($plans[$plan->id]);
                      $plans      = array(0 => $lang->null) + $plans;
                      $withSearch = count($plans) > 8;
                      echo "<li class='dropdown-submenu'>";
                      echo html::a('javascript:;', $lang->story->planAB, '', "id='planItem'");
                      echo "<div class='dropdown-menu" . ($withSearch ? ' with-search':'') . "'>";
                      echo '<ul class="dropdown-list">';
                      foreach($plans as $planID => $planName)
                      {
                          $actionLink = $this->createLink('story', 'batchChangePlan', "planID=$planID&oldPlanID=$plan->id");
                          echo "<li class='option' data-key='$planID'>" . html::a('#', $planName, '', "onclick=\"setFormAction('$actionLink','hiddenwin', this)\"") . "</li>";
                      }
                      echo '</ul>';
                      if($withSearch) echo "<div class='menu-search'><div class='input-group input-group-sm'><input type='text' class='form-control' placeholder=''><span class='input-group-addon'><i class='icon-search'></i></span></div></div>";
                      echo '</div></li>';
                  }
                  else
                  {
                      echo '<li>' . html::a('javascript:;', $lang->story->planAB, '', $class) . '</li>';
                  }

                  if($canBatchChangeStage)
                  {
                      echo "<li class='dropdown-submenu'>";
                      echo html::a('javascript:;', $lang->story->stageAB, '', "id='stageItem'");
                      echo "<ul class='dropdown-menu'>";
                      $lang->story->stageList[''] = $lang->null;
                      foreach($lang->story->stageList as $key => $stage)
                      {
                          $actionLink = $this->createLink('story', 'batchChangeStage', "stage=$key");
                          echo "<li>" . html::a('#', $stage, '', "onclick=\"setFormAction('$actionLink','hiddenwin', this)\"") . "</li>";
                      }
                      echo '</ul></li>';
                  }
                  else
                  {
                      echo '<li>' . html::a('javascript:;', $lang->story->stageAB, '', $class) . '</li>';
                  }

                  if($canBatchAssignTo)
                  {
                        $withSearch = count($users) > 10;
                        $actionLink = $this->createLink('story', 'batchAssignTo', "productID=$plan->product");
                        echo html::select('assignedTo', $users, '', 'class="hidden"');
                        echo "<li class='dropdown-submenu'>";
                        echo html::a('javascript::', $lang->story->assignedTo, '', 'id="assignItem"');
                        echo "<div class='dropdown-menu" . ($withSearch ? ' with-search':'') . "'>";
                        echo '<ul class="dropdown-list">';
                        foreach ($users as $key => $value)
                        {
                            if(empty($key) or $key == 'closed') continue;
                            echo "<li class='option' data-key='$key'>" . html::a("javascript:$(\".table-actions #assignedTo\").val(\"$key\");setFormAction(\"$actionLink\", false, \"#storyList\")", $value, '', '') . '</li>';
                        }
                        echo "</ul>";
                        if($withSearch) echo "<div class='menu-search'><div class='input-group input-group-sm'><input type='text' class='form-control' placeholder=''><span class='input-group-addon'><i class='icon-search'></i></span></div></div>";
                        echo "</div></li>";
                  }
                  else
                  {
                      echo '<li>' . html::a('javascript:;', $lang->story->assignedTo, '', $class) . '</li>';
                  }
                  ?>
                </ul>
              </div>
            </div>
            <?php endif;?>
            <div class='text'><?php echo $summary;?></div>
          </div>
          <?php endif;?>
        </form>
      </div>
      <div id='bugs' class='tab-pane <?php if($type == 'bug') echo 'active';?>'>
        <?php if(common::hasPriv('productplan', 'linkBug')):?>
        <div class='actions'>
        <?php echo html::a("javascript:showLink($plan->id, \"bug\")", '<i class="icon-bug"></i> ' . $lang->productplan->linkBug, '', "class='btn btn-primary'");?>
        </div>
        <div class='linkBox cell hidden'></div>
        <?php endif;?>
        <form class='main-table table-bug' data-ride='table' method='post' target='hiddenwin' action="<?php echo inLink('batchUnlinkBug', "planID=$plan->id&orderBy=$orderBy");?>">
          <table class='table has-sort-head' id='bugList'>
            <?php $canBatchUnlink = common::hasPriv('productplan', 'batchUnlinkBug');?>
            <?php $vars = "planID={$plan->id}&type=bug&orderBy=%s&link=$link&param=$param"; ?>
            <thead>
              <tr class='text-center'>
                <th class='c-id text-left'>
                  <?php if($planBugs && $canBatchUnlink):?>
                  <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
                    <label></label>
                  </div>
                  <?php endif;?>
                  <?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?>
                </th>
                <th class='w-70px'> <?php common::printOrderLink('pri',        $orderBy, $vars, $lang->priAB);?></th>
                <th class='text-left'><?php common::printOrderLink('title',      $orderBy, $vars, $lang->bug->title);?></th>
                <th class='c-user'> <?php common::printOrderLink('openedBy',   $orderBy, $vars, $lang->openedByAB);?></th>
                <th class='c-user'> <?php common::printOrderLink('assignedTo', $orderBy, $vars, $lang->bug->assignedToAB);?></th>
                <th class='w-100px'><?php common::printOrderLink('status',     $orderBy, $vars, $lang->bug->status);?></th>
                <th class='w-50px'> <?php echo $lang->actions?></th>
              </tr>
            </thead>
            <tbody class='text-center'>
              <?php foreach($planBugs as $bug):?>
              <tr>
                <td class='c-id text-left'>
                  <?php if($canBatchUnlink):?>
                  <?php echo html::checkbox('unlinkBugs', array($bug->id => sprintf('%03d', $bug->id)));?>
                  <?php else:?>
                  <?php printf('%03d', $bug->id);?>
                  <?php endif;?>
                </td>
                <td><span class='label-pri label-pri-<?php echo $bug->pri;?>' title='<?php echo zget($lang->bug->priList, $bug->pri, $bug->pri);?>'><?php echo zget($lang->bug->priList, $bug->pri, $bug->pri);?></span></td>
                <td class='text-left nobr' title='<?php echo $bug->title?>'><?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id"), $bug->title);?></td>
                <td><?php echo zget($users, $bug->openedBy);?></td>
                <td><?php echo zget($users, $bug->assignedTo);?></td>
                <td>
                  <span class='status-bug status-<?php echo $bug->status?>'>
                    <?php echo $lang->bug->statusList[$bug->status];?>
                  </span>
                </td>
                <td class='c-actions'>
                  <?php
                  if(common::hasPriv('productplan', 'unlinkBug'))
                  {
                      $unlinkURL = $this->createLink('productplan', 'unlinkBug', "story=$bug->id&confirm=yes");
                      echo html::a("javascript:ajaxDelete(\"$unlinkURL\",\"bugList\",confirmUnlinkBug)", '<i class="icon-unlink"></i>', '', "class='btn' title='{$lang->productplan->unlinkBug}'");
                  }
                  ?>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <?php if($planBugs):?>
          <div class='table-footer'>
            <?php if($canBatchUnlink):?>
            <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
            <div class="table-actions btn-toolbar">
              <?php echo html::submitButton($lang->productplan->batchUnlink, '', 'btn');?>
            </div>
            <?php endif;?>
            <div class='text'><?php echo sprintf($lang->productplan->bugSummary, count($planBugs));?></div>
          </div>
          <?php endif;?>
        </form>
      </div>
      <div id='planInfo' class='tab-pane'>
        <div class='cell'>
          <div class='detail'>
            <div class='detail-title'><?php echo $lang->productplan->basicInfo;?></div>
            <div class='detail-content'>
              <table class='table table-data table-condensed table-borderless'>
                <tr>
                  <th class='w-80px strong'><?php echo $lang->productplan->title;?></th>
                  <td><?php echo $plan->title;?></td>
                </tr>
                <?php if($product->type != 'normal'):?>
                <tr>
                  <th><?php echo $lang->product->branch;?></th>
                  <td><?php echo $branches[$plan->branch];?></td>
                </tr>
                <?php endif;?>
                <tr>
                  <th><?php echo $lang->productplan->begin;?></th>
                  <td><?php echo $plan->begin == '2030-01-01' ? $lang->productplan->future : $plan->begin;?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->productplan->end;?></th>
                  <td><?php echo $plan->end == '2030-01-01' ? $lang->productplan->future : $plan->end;?></td>
                </tr>
                <tr>
                  <th><?php echo $lang->productplan->desc;?></th>
                  <td><?php echo $plan->desc;?></td>
                </tr>
              </table>
            </div>
          </div>
          <?php include '../../common/view/action.html.php';?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php js::set('param', helper::safe64Decode($param))?>
<?php js::set('link', $link)?>
<?php js::set('planID', $plan->id)?>
<?php js::set('orderBy', $orderBy)?>
<?php js::set('type', $type)?>
<?php include '../../common/view/footer.html.php';?>
