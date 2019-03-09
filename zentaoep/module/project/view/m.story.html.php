<?php
/**
 * The story browse mobile view file of project module of ZenTaoPMS.
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
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('project', 'story', "projectID={$project->id}&orderBy=%s&type=$type&param=$param&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}");?>
  <div class='box' data-page='<?php echo $pager->pageID;?>' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->story->title;?> </th>
          <th class='text-center w-80px'><?php echo $lang->story->stage;?> </th>
        </tr>
      </thead>
      <?php foreach($stories as $story):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('story', 'view', "storyID={$story->id}")?>' data-id='<?php echo $story->id;?>'>
        <td class='text-left'><?php echo $story->title;?></td>
        <td class='story-<?php echo $story->stage?>'><?php echo zget($lang->story->stageList, $story->stage);?></td>
      </tr>
      <?php endforeach;?>
      <?php if($stories):?>
      <tfoot>
        <tr><td colspan='2'><small><?php echo $summary?></small></td></tr>
      </tfoot>
      <?php endif;?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "projectID={$project->id}&orderBy=%s&type=$type&param=$param&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $sortOrders = array('id', 'pri', 'title', 'plan', 'openedBy', 'openedDate', 'assignedTo', 'status');
  foreach($sortOrders as $sortOrder)
  {
      commonModel::printOrderLink($sortOrder, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->story->{$sortOrder});
  }
  ?>
</div>

<?php include "../../common/view/m.footer.html.php"; ?>
