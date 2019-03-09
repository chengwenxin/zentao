<?php
/**
 * The zeroCase mobile view file of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     story
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$branch     = 0;
$browseType = 'zerocase';
?>
<?php include '../../testcase/view/m.caseheader.html.php';?>
<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('story', 'zerocase', http_build_query($this->app->getParams()));?>
  <div class='box' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th class='w-50px'><?php echo $lang->story->id;?></th>
          <th class='w-40px'><?php echo $lang->priAB;?></th>
          <th><?php echo $lang->story->title;?></th>
          <th class='w-80px text-center'><?php echo $lang->story->status;?></th>
        </tr>
      </thead>
      <?php foreach($stories as $story):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('story', 'view', "storyID={$story->id}")?>' data-id='<?php echo$story->id;?>'>
        <td><?php echo $story->id;?></td>
		<td><span class='<?php echo 'pri' . zget($lang->story->priList, $story->pri, $story->pri);?>'><?php echo zget($lang->story->priList, $story->pri, $story->pri)?></span></td>
        <td class='text-left'>
        <?php echo "<span style='color:$story->color'>" . $story->title . '</span>';?>
        </td>
        <td class='story-<?php echo $story->status;?>'><?php echo zget($lang->story->statusList, $story->status);?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "productID=$productID&orderBy=%s";
  $sortOrders = array('id', 'pri', 'title', 'status', 'openedBy', 'openedDate', 'type', 'lastRunner', 'lastRunDate', 'lastRunResult');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->testcase->{$order}));
  }
  ?>
</div>
<script>
$(function()
{
    $('#<?php echo $browseType;?>Tab').addClass('active');
})
</script>
<?php include '../../common/view/m.footer.html.php';?>
