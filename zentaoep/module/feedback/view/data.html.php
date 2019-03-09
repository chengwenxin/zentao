<?php
/**
 * The data view file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     feedback
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php $adminMethod = $this->app->getMethodName() == 'admin';?>
<table class='table has-sort-head' id='feedbackList'>
  <thead>
    <?php $vars = "browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
    <tr>
      <th class='w-60px'> <?php common::printOrderLink('id',         $orderBy, $vars, $lang->idAB);?></th>
      <th class='w-150px hidden-xs'><?php common::printOrderLink('product',    $orderBy, $vars, $lang->feedback->product);?></th>
      <th>                <?php common::printOrderLink('title',      $orderBy, $vars, $lang->feedback->title);?></th>
      <th class='w-80px'> <?php common::printOrderLink('status',     $orderBy, $vars, $lang->feedback->status);?></th>
      <?php if(isset($userDeptPairs)):?>
      <th class='w-80px'> <?php echo $lang->feedback->dept;?></th>
      <?php endif;?>
      <th class='w-80px'> <?php common::printOrderLink('openedBy',   $orderBy, $vars, $lang->feedback->openedBy);?></th>
      <th class='w-90px hidden-xs hidden-sm'><?php common::printOrderLink('openedDate', $orderBy, $vars, $lang->feedback->openedDate);?></th>
      <th class='w-90px hidden-xs hidden-sm'> <?php common::printOrderLink('processedBy',   $orderBy, $vars, $lang->feedback->processedBy);?></th>
      <th class='w-100px hidden-xs hidden-sm'><?php common::printOrderLink('processedDate', $orderBy, $vars, $lang->feedback->processedDate);?></th>
      <th class='w-150px'><?php common::printOrderLink('closedReason', $orderBy, $vars, $lang->feedback->closedReason);?></th>
      <th class="<?php echo $adminMethod ? 'w-230px' : 'w-120px';?>"><?php echo $lang->actions?></th>
    </tr>
  </thead>
  <?php if($feedbacks):?>
  <tbody>
    <?php foreach($feedbacks as $feedback):?>
    <tr>
      <td><?php echo html::a(inlink($viewMethod, "id=$feedback->id&browseType=$browseType"), sprintf('%03d', $feedback->id));?></td>
      <td class='hidden-xs'><?php echo zget($allProducts, $feedback->product, '')?></td>
      <td class='text-left'>
      <?php
      if($feedback->public) echo "<span class='label label-info'>{$lang->feedback->public}</span> ";
      echo html::a(inlink($viewMethod, "id=$feedback->id&browseType=$browseType"), $feedback->title);
      ?>
      </td>
      <td class="status-<?php echo $feedback->status;?>"><?php echo zget($lang->feedback->statusList, $feedback->status)?></td>
      <?php if(isset($userDeptPairs)):?>
      <td> <?php echo zget($userDeptPairs, $feedback->openedBy, '');?></td>
      <?php endif;?>
      <td><?php echo zget($users, $feedback->openedBy)?></td>
      <td class='hidden-xs hidden-sm' title='<?php echo $feedback->openedDate ?>'><?php echo substr($feedback->openedDate, 5, 11);?></td>
      <td class='hidden-xs hidden-sm'><?php echo zget($users, $feedback->processedBy)?></td>
      <td class='hidden-xs hidden-sm' title='<?php echo $feedback->processedDate ?>'><?php echo substr($feedback->processedDate, 5, 11);?></td>
      <td class='text-left'>
        <?php
        if($feedback->closedReason)
        {
            echo zget($lang->feedback->closedReasonList, $feedback->closedReason);
            if($feedback->closedReason == 'tostory' and isset($stories[$feedback->result])) echo " #{$feedback->result} <span class='label label-info'>" . zget($lang->story->stageList, $stories[$feedback->result]->stage) . "</span>";
            if($feedback->closedReason == 'tobug'   and isset($bugs[$feedback->result]))    echo " #{$feedback->result} <span class='label label-info'>" . zget($lang->bug->statusList, $bugs[$feedback->result]->status) . "</span>";
        }
        ?>
      </td>
      <td class='c-actions'>
        <?php
        $self = $feedback->openedBy == $this->app->user->account;

        if($self and $feedback->status == 'wait')
        {
            echo html::a(inlink('edit', "id=$feedback->id"), "<i class='icon-edit'></i>", '', "class='btn' title='{$lang->feedback->edit}'");
        }
        else
        {
            echo html::a('javascript:;', "<i class='icon-edit'></i>", '', "class='btn disabled' title='{$lang->feedback->edit}'");
        }

        if($adminMethod)
        {
            if($feedback->status != 'closed')
            {
                common::printIcon('feedback', 'comment', "feedbackID=$feedback->id&type=replied", $feedback, 'list', 'restart', '', 'iframe', '', '', $lang->feedback->reply);
                if($config->global->flow == 'full' or $config->global->flow == 'onlyStory') common::printIcon('story', 'create', "product=$feedback->product&branch=0&moduleID=0&storyID=0&projectID=0&bugID=0&planID=0&todoID=0&extra=feedbackID=$feedback->id", '', 'list', $lang->icons['story'], '', '', '', '', $lang->feedback->toStory);
                if($config->global->flow == 'full' or $config->global->flow == 'onlyTest')  common::printIcon('bug',   'create', "product=$feedback->product&branch=0&extras=feedbackID=$feedback->id", '', 'list', $lang->icons['bug'], '', '', '', '', $lang->feedback->toBug);
            }
            else
            {
                echo html::a('javascript:;', "<i class='icon-feedback-comment icon-restart'></i>", '', "class='btn disabled' title='{$lang->feedback->reply}'");
                if($config->global->flow == 'full' or $config->global->flow == 'onlyStory') echo html::a('javascript:;', "<i class='icon-{$lang->icons['story']}'></i>", '', "class='btn disabled' title='{$lang->feedback->toStory}'");
                if($config->global->flow == 'full' or $config->global->flow == 'onlyTest') echo html::a('javascript:;', "<i class='icon-{$lang->icons['bug']}'></i>", '', "class='btn disabled' title='{$lang->feedback->toBug}'");
            }
        }

        if(($self or ($adminMethod and common::hasPriv('feedback', 'close', $feedback))) and $feedback->status != 'closed')
        {
            echo html::a(inlink('close', "id=$feedback->id"), "<i class='icon-off'></i>", '', "class='btn iframe' title='{$lang->feedback->close}'");
        }
        else
        {
            echo html::a('javascript:;', "<i class='icon-off'></i>", '', "class='btn iframe disabled' title='{$lang->feedback->close}'");
        }

        if($self and $feedback->status == 'wait')
        {
            echo html::a(inlink('delete', "id=$feedback->id"), "<i class='icon-trash'></i>", 'hiddenwin', "class='btn' title='{$lang->feedback->delete}'");
        }
        else
        {
            echo html::a('javascript:;', "<i class='icon-trash'></i>", 'hiddenwin', "class='btn disabled' title='{$lang->feedback->delete}'");
        }
        ?>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
  <?php endif;?>
</table>
<div class='table-footer'><?php $pager->show('right', 'pagerjs');?></div>
