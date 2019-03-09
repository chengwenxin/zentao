<?php
/**
 * The dynamic mobile view file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.zentao.net
 */

$bodyClass = 'with-menu-top';
?>
<?php include "../../common/view/m.header.html.php";?>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php
  echo html::a(inlink('dynamic', "productID=$productID&type=today"),      $lang->action->dynamic->today, '', "id='today'");
  echo html::a(inlink('dynamic', "productID=$productID&type=yesterday"),  $lang->action->dynamic->yesterday, '', "id='yesterday'");
  echo html::a(inlink('dynamic', "productID=$productID&type=twodaysago"), $lang->action->dynamic->twoDaysAgo, '', "id='twodaysago'");
  echo html::a(inlink('dynamic', "productID=$productID&type=thisweek"),   $lang->action->dynamic->thisWeek, '', "id='thisweek'");
  echo html::a(inlink('dynamic', "productID=$productID&type=lastweek"),   $lang->action->dynamic->lastWeek, '', "id='lastweek'");
  echo html::a(inlink('dynamic', "productID=$productID&type=thismonth"),  $lang->action->dynamic->thisMonth, '', "id='thismonth'");
  echo html::a(inlink('dynamic', "productID=$productID&type=lastmonth"),  $lang->action->dynamic->lastMonth, '', "id='lastmonth'");
  echo html::a(inlink('dynamic', "productID=$productID&type=all"),        $lang->action->dynamic->all, '', "id='all'");
  echo html::select('account', $users, $account, "class='account-select'");
  ?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('product', 'dynamic', "productID=$productID&type=$type&param=$param&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}");?>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th class='w-150px'><?php echo $lang->action->date;?></th>
          <th class='w-80px'> <?php echo $lang->action->actor;?></th>
          <th class='w-80px'><?php echo $lang->action->action;?></th>
          <th><?php echo $lang->action->objectName;?></th>
        </tr>
      </thead>
      <?php foreach($dateGroups as $actions):?>
      <?php foreach($actions as $action):?>
      <tr class='text-center' data-url='<?php echo $action->objectLink?>'>
        <td class='text-left'><?php echo $action->date;?></td>
        <td><?php isset($users[$action->actor]) ? print($users[$action->actor]) : print($action->actor);?></td>
        <td><?php echo $action->actionLabel;?></td>
        <td class='text-left'><?php echo '[' . $lang->action->objectTypes[$action->objectType] . ' #' . $action->objectID . '] ' . $action->objectName;?></td>
      </tr>
      <?php endforeach;?>
      <?php endforeach;?>
    </table>
  </div>
  <nav class='nav justified pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "productID=$productID&type=$type&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  $sortOrders = array('date', 'actor', 'action', 'objectType', 'objectID');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->action->{$order}));
  }
  ?>
</div>
<script>
$(function()
{
    $('#<?php echo $type;?>').addClass('active');
    $('#account').change(function()
    {
        if(account == '')
        {
            link = createLink('product', 'dynamic', 'productID=<?php echo $productID?>&type=all');
        }
        else
        {
            link = createLink('product', 'dynamic', 'productID=<?php echo $productID?>&type=account&param=' + $(this).val());
        }
        location.href = link;
    });
});
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
