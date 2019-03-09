<?php
/**
 * The browse mobile view file of testtask module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     testtask
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$bodyClass = $config->global->flow == 'full' ? 'with-menu-top' : '';
include "../../common/view/m.header.html.php";
$scope = $this->session->testTaskVersionScope;
$status = $this->session->testTaskVersionStatus;
?>
<?php if($config->global->flow == 'full'):?>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php echo html::a(inlink('browse', "productID=$productID&branch=$branch&type=$scope,wait"), $lang->testtask->wait, '', "id='waitTab'");?>
  <?php echo html::a(inlink('browse', "productID=$productID&branch=$branch&type=$scope,doing"), $lang->testtask->testing, '', "id='doingTab'");?>
  <?php echo html::a(inlink('browse', "productID=$productID&branch=$branch&type=$scope,blocked"), $lang->testtask->blocked, '', "id='blockedTab'");?>
  <?php echo html::a(inlink('browse', "productID=$productID&branch=$branch&type=$scope,done"), $lang->testtask->done, '', "id='doneTab'");?>
  <?php echo html::a(inlink('browse', "productID=$productID&branch=$branch&type=$scope,totalStatus"), $lang->testtask->totalStatus, '', "id='totalStatusTab'");?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>
<?php endif;?>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('testtask', 'browse', http_build_query($this->app->getParams()));?>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->testtask->name;?></th>
          <th class='w-100px'><?php echo $lang->testtask->begin;?></th>
          <th class='w-100px'><?php echo $lang->testtask->end;?></th>
        </tr>
      </thead>
      <?php foreach($tasks as $task):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('testtask', 'cases', "taskID={$task->id}")?>' data-id='<?php echo$task->id;?>'>
        <td class='text-left'><?php echo $task->name;?></td>
        <td><?php echo $task->begin;?></td>
        <td><?php echo $task->end;?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <nav class='nav justified pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php $vars = "productID=$productID&branch=$branch&type=$scope,$status&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"; ?>
  <?php
  $sortOrders = array('id', 'name', 'begin', 'end', 'owner', 'status', 'build');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->testtask->{$order}));
  }
  ?>
</div>
<script>
$(function()
{
    $('#<?php echo $status?>Tab').addClass('active')
    <?php if($config->global->flow != 'full'):?>
    $('#appnav a').removeClass('active');
    $("#appnav a[href*='<?php echo $status?>']").addClass('active');
    <?php endif;?>
})
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
