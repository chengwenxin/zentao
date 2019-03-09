<?php
/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     project 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php foreach($lang->effort->periods as $period => $label):?>
    <?php
    $vars   = "projectID=$projectID&date=$period";
    $active = '';
    $label  = "<span class='text'>$label</span>";
    if($period == $date)
    {
        $active = 'btn-active-text';
        $label .= " <span class='label label-light label-badge'>{$pager->recTotal}</span>";
    }
    echo html::a(inlink('effort', $vars), $label, '', "class='btn btn-link $active' id='{$period}'")
    ?>
    <?php endforeach;?>
    <div class='input-control space w-150px'>
      <?php echo html::input('date', $today, "class='form-date form-control' id='$today' onchange='changeDate($projectID, this.value)'");?>
    </div>
    <div class='input-control space w-150px'>
      <?php echo html::select('account', $users, $account, "class='form-control chosen' id='account' onchange='changeUser($projectID, \"$date\", this.value)'");?>
    </div>
  </div>
  <div class='btn-toolbar pull-right'>
    <?php common::printIcon('effort', 'export', "account=$account&orderBy=date_asc", '', 'button', '', '', 'export iframe');?>
  </div>
</div>
<div id="mainContent">
  <form class='main-table' data-ride='table' id='effortForm' method='post' action='<?php echo $this->createLink('effort', 'batchEdit', "from=browse&account=" . ($account == 'all' ? '' : $account))?>'>
    <table id='effortList' class='table has-sort-head table-fixed'>
      <?php $vars = "projectID=$projectID&date=$date&account=$account&orderBy=%s&recTotal=$pager->recTotal&recPerPage=$pager->recPerPage"; ?>
      <thead>
        <tr>
          <th class='c-id'><?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>
          <th class='w-date'><?php common::printOrderLink('date',       $orderBy, $vars, $lang->effort->date);?></th>
          <th class='w-80px'><?php common::printOrderLink('account',    $orderBy, $vars, $lang->effort->account);?></th>
          <th>               <?php common::printOrderLink('work',       $orderBy, $vars, $lang->effort->work);?></th>
          <th class='w-80px'><?php common::printOrderLink('consumed',   $orderBy, $vars, $lang->effort->consumed);?></th>
          <th class='w-80px'><?php common::printOrderLink('left',       $orderBy, $vars, $lang->effort->left);?></th>
          <th width='350'>   <?php common::printOrderLink('objectType', $orderBy, $vars, $lang->effort->objectType);?></th>
        </tr>
      </thead>
      <tbody>
        <?php $times = 0?>
        <?php foreach($efforts as $effort):?>
        <tr>
          <td><?php printf('%03d', $effort->id);?></td>
          <td><?php echo $effort->date;?></td>
          <td><?php echo $accounts[$effort->account];?></td>
          <td class='text-left'><?php echo html::a($this->createLink('effort', 'view', "id=$effort->id&from=my", '', true), $effort->work, '', "class='effortview iframe'");?></td>
          <td><?php echo $effort->consumed;?></td>
          <td><?php echo $effort->left;?></td>
          <td class='text-left'><?php if($effort->objectType != 'custom') echo html::a($this->createLink($effort->objectType, 'view', "id=$effort->objectID"),$effort->objectTitle);?></td>
        </tr>
        <?php $times += $effort->consumed;?>
        <?php endforeach;?>
      </tbody>
    </table>
    <?php if($efforts):?>
    <div class='table-footer'>
      <?php if($times):?>
      <?php printf('<div class="text pull-left" style="line-height:28px;">' . $lang->company->effort->timeStat . '</div>', $times);?>
      <?php endif;?>
      <?php $pager->show('right', 'pagerjs');?>
    </div>
    <?php endif;?>
  </form>
</div>
<?php include '../../../common/view/footer.html.php';?>
