<?php
/**
 * The effort browse mobile view file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong <yidong@cnezsoft.com>
 * @package     company
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */
?>

<?php
$bodyClass = 'with-menu-top';
include "../../common/view/m.header.html.php";
?>

<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php 
  echo html::a(inlink('effort', "type=today"),      $lang->effort->todayEfforts);
  echo html::a(inlink('effort', "type=yesterday"),  $lang->effort->yesterdayEfforts);
  echo html::a(inlink('effort', "type=thisweek"),   $lang->effort->thisWeekEfforts);
  echo html::a(inlink('effort', "type=lastweek"),   $lang->effort->lastWeekEfforts);
  echo html::a(inlink('effort', "type=thismonth"),  $lang->effort->thisMonthEfforts);
  echo html::a(inlink('effort', "type=lastmonth"),  $lang->effort->lastMonthEfforts);
  echo html::a(inlink('effort', "type=all"),        $lang->effort->allDaysEfforts);
  ?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <nav class='nav fluid'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </nav>
</div>

<section id='page' class='section list-with-actions list-with-pager'>
  <?php $refreshUrl = $this->createLink('company', 'effort', "date=$date&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}");?>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered'>
      <?php foreach($efforts as $effort): ?>
      <tr data-id='<?php echo $effort->id;?>'>
        <td class='w-80px'><?php echo zget($users, $effort->account);?></td>
        <td>
          <?php
          $viewLink = $this->createLink('effort', 'view', "effortID={$effort->id}", '', true); 
          echo common::hasPriv('effort', 'view') ? "<a class='text-link' data-display='modal' data-placement='bottom' data-remote='$viewLink'>{$effort->work}</a>" : $effort->work;
          ?>
        </td>
        <td class='w-120px'><?php echo $effort->date ?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $sortOrders = array('id', 'date', 'actor', 'action', 'objectType');
  foreach ($sortOrders as $sortOrder)
  {
      commonModel::printOrderLink($sortOrder, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($sortOrder == 'id' ? $lang->action->actionID : $lang->action->{$sortOrder}));
  }
  ?>
</div>

<script>
$('#menu > a').removeClass('active').filter('[href*="<?php echo $date ?>"]').addClass('active');
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
