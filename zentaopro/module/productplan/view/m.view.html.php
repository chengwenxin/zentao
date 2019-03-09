<?php
/**
 * The view mobile view file of productplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     productplan
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<?php $browseLink = $this->session->productPlanList ? $this->session->productPlanList : inlink('browse', "planID=$plan->id");?>
<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $plan->id;?></strong></span>
      <strong><?php echo $plan->title;?></strong>
      <?php if($product->type !== 'normal') echo "<span class='label label-branchlabel-badge'>" . $branches[$branch] . '</span>';?>
      <span class='label label-info label-badge'><?php echo $plan->begin . '~' . $plan->end;?></span>
    </div>
    <nav class='nav'>
      <a href='<?php echo $browseLink;?>' class='btn primary'><?php echo $lang->goback;?></a>
    </nav>
  </div>
  <div class='section no-margin'>
    <div class="outline">
      <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
        <a class='<?php if($type == 'story') echo 'active'?>' data-target="#stories"><?php echo $lang->productplan->linkedStories?></a>
        <a class='<?php if($type == 'bug') echo 'active'?>' data-target="#bugs"><?php echo $lang->productplan->linkedBugs?></a>
        <a data-target="#planInfo"><?php echo $lang->productplan->view?></a>
      </nav>
      <div>
        <div class="display <?php echo $type == 'story' ? 'in' : 'hidden'?>" id="stories">
          <div class='heading gray'>
            <div class='title'>
              <a id='storySortTrigger' class='text-right sort-trigger' data-display data-target='#storySortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
            </div>
          </div>
          <table class='table bordered'>
            <thead>
              <tr>
                <th class='w-50px' > <?php echo $lang->idAB;?></th>
                <th class='w-30px'>  <?php echo $lang->priAB;?></th>
                <th>                 <?php echo $lang->story->title;?></th>
                <th class='w-70px'>  <?php echo $lang->statusAB;?></th>
                <th class='w-70px'>  <?php echo $lang->story->stageAB;?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($planStories as $story):?>
              <?php $viewLink = $this->createLink('story', 'view', "storyID=$story->id");?>
              <tr class='text-center' data-url='<?php echo $viewLink?>'>
                <td><?php echo $story->id;?></td>
                <td><span class='<?php echo 'pri' . zget($lang->story->priList, $story->pri, $story->pri)?>'><?php echo zget($lang->story->priList, $story->pri, $story->pri);?></span></td>
                <td class='text-left'>
                  <?php if($modulePairs and $story->module) echo "<span title='{$lang->story->module}' class='label label-info label-badge'>{$modulePairs[$story->module]}</span> "?>
                  <?php echo $story->title;?>
                </td>
                <td class='story-<?php echo $story->status?>'><?php echo $lang->story->statusList[$story->status];?></td>
                <td><?php echo $lang->story->stageList[$story->stage];?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan='5'><div class='text'><?php echo $summary;?></div></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="display <?php echo $type == 'bug' ? 'in' : 'hidden'?>" id="bugs">
          <div class='heading gray'>
            <div class='title'>
              <a id='bugSortTrigger' class='text-right sort-trigger' data-display data-target='#bugSortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
            </div>
          </div>
          <table class='table bordered'>
            <thead>
              <tr>
                <th class='w-50px'><?php echo $lang->idAB;?></th>
                <th class='w-30px'><?php echo $lang->priAB;?></th>
                <th >              <?php echo $lang->bug->title;?></th>
                <th class='w-80px'><?php echo $lang->assignedToAB;?></th>
                <th class='w-70px'><?php echo $lang->statusAB;?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($planBugs as $bug):?>
              <tr class='text-center' data-url='<?php echo $this->createLink('bug', 'view', "bugID=$bug->id")?>'>
                <td><?php echo $bug->id;?></td>
                <td><span class='<?php echo 'pri' . zget($lang->bug->priList, $bug->pri, $bug->pri)?>'><?php echo zget($lang->bug->priList, $bug->pri, $bug->pri);?></span></td>
                <td class='text-left'><?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id"), $bug->title);?></td>
                <td><?php echo zget($users, $bug->assignedTo);?></td>
                <td class='bug-<?php echo $bug->status?>'><?php echo $lang->bug->statusList[$bug->status];?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan='5'>
                  <div class='text'><?php echo sprintf($lang->productplan->bugSummary, count($planBugs));?> </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="display hidden" id="planInfo">
            <div class='heading gray'>
              <div class='title'><strong><?php echo $lang->productplan->basicInfo?></strong></div>
            </div>
            <table class='table bordered table-detail'>
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
                <td><?php echo $plan->begin;?></td>
              </tr>
              <tr>
                <th><?php echo $lang->productplan->end;?></th>
                <td><?php echo $plan->end;?></td>
              </tr>
            </table>
            <?php if($plan->desc):?>
            <div class='heading gray'>
              <div class='title'><strong><?php echo $lang->productplan->desc;?></strong></div>
            </div>
            <div class='article'><?php echo $plan->desc;?></div>
            <?php endif;?>
            <?php include '../../common/view/m.action.html.php';?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='storySortPanel'>
  <?php
  $vars = "planID={$plan->id}&type=story&orderBy=%s&link=$link&param=$param";
  $sortOrders = array('id', 'pri', 'title', 'status', 'stage');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->story->{$order}));
  }
  ?>
</div>
<div class='list sort-panel hidden affix enter-from-bottom layer' id='bugSortPanel'>
  <?php
  $vars = "planID={$plan->id}&type=bug&orderBy=%s&link=$link&param=$param";
  $sortOrders = array('id', 'pri', 'title', 'assignedTo', 'status');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->bug->{$order}));
  }
  ?>
</div>
<?php include '../../common/view/m.footer.html.php';?>
