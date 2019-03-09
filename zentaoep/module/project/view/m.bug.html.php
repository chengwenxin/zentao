<?php
/**
 * The bug browse mobile view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     project
 * @version     $Id
 * @link        http://www.zentao.net
 */

include "../../common/view/m.header.html.php";
?>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
  <nav class='nav'>
    <a data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('bug', 'create', "productID=$productID&branch=$branchID&extra=projectID=$project->id");?>' class='btn primary'><i class='icon icon-plus'> </i> &nbsp;&nbsp;<?php echo $lang->bug->create;;?></a>
  </nav>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('project', 'bug', "projectID={$project->id}&orderBy=%s&build=$buildID&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}");?>
  <div class='box' data-page='<?php echo $pager->pageID;?>' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->bug->title;?> </th>
          <th class='text-center w-70px'><?php echo $lang->statusAB;?> </th>
        </tr>
      </thead>
      <?php foreach($bugs as $bug):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('bug', 'view', "bugID={$bug->id}")?>' data-id='<?php echo $bug->id;?>'>
        <td class='text-left'><?php echo $bug->title;?></td>
        <td><?php echo zget($lang->bug->statusList, $bug->status);?></td>
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
  $vars = "projectID={$project->id}&orderBy=%s&build=$buildID&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $sortOrders = array('id', 'pri', 'title', 'assignedTo', 'type', 'status', 'openedDate', 'openedBy', 'resolvedBy', 'resolution');
  foreach($sortOrders as $sortOrder)
  {
      commonModel::printOrderLink($sortOrder, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->bug->{$sortOrder});
  }
  ?>
</div>

<?php include "../../common/view/m.footer.html.php"; ?>
