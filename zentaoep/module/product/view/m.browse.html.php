<?php
/**
 * The browse mobile view file of product module of ZentTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     product 
 * @version     $Id$
 * @link        http://www.zentao.net
 */

$featureMenu = customModel::getFeatureMenu($this->moduleName, $this->methodName);
if($featureMenu) $bodyClass = 'with-menu-top';
include "../../common/view/m.header.html.php";
?>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php foreach($featureMenu as $menuItem):?>
    <?php if(isset($menuItem->hidden)) continue;?>
    <?php if(strpos($menuItem->name, 'QUERY') === 0):?>
    <?php $queryID = (int)substr($menuItem->name, 5);?>
    <?php echo html::a(inlink('browse', "productID=$productID&branch=$branch&browseType=bySearch&param=$queryID"), $menuItem->text, '', "id='{$menuItem->name}Tab'");?>
    <?php else:?>
    <?php echo html::a(inlink('browse', "productID=$productID&branch=$branch&browseType=$menuItem->name"), $menuItem->text, '', "id='{$menuItem->name}Tab'");?>
    <?php endif;?>
  <?php endforeach;?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
  <?php if(common::hasPriv('story', 'create')):?>
  <nav class='nav'>
    <a class='btn primary' data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('story', 'create', "productID=$productID&branch=$branch")?>'>
      <i class='icon icon-plus'></i> &nbsp;&nbsp;<?php echo $lang->story->create;?>
    </a>
  </nav>
  <?php endif;?>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('product', 'browse', "productID=$productID&branch=$branch&browseType=$browseType&param=$param&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}");?>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->story->title;?></th>
          <th class='w-80px text-center'><?php echo $lang->statusAB;?></th>
          <th class='w-80px text-center'><?php echo $lang->story->stageAB;?></th>
        </tr>
      </thead>
      <?php foreach($stories as $story):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('story', 'view', "storyID={$story->id}")?>' data-id='<?php echo$story->id;?>'>
        <td class='text-left'>
        <?php if($story->branch) echo "<span title='{$lang->product->branchName[$product->type]}' class='label label-branch label-badge'>{$branches[$story->branch]}</span>"?>
        <?php if($modulePairs and $story->module) echo "<span title='{$lang->story->module}' class='label label-info label-badge'>{$modulePairs[$story->module]}</span> "?>
        <?php echo "<span style='color:$story->color'>" . $story->title . '</span>';?>
        </td>
        <td class='story-<?php echo $story->status?>'><?php echo zget($lang->story->statusList, $story->status);?></td>
        <td><?php echo zget($lang->story->stageList, $story->stage);?></td>
      </tr>
      <?php endforeach;?>
      <?php if(!empty($stories)):?>
      <tfoot>
        <tr>
          <td class='text-red small' colspan='3'><div class='text'><?php echo $summary;?></div></td>
        </tr>
      </tfoot>
      <?php endif;?>
    </table>
  </div>
  <nav class='nav justified pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "productID=$productID&branch=$branch&browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  $sortOrders = array('id', 'pri', 'title', 'plan', 'openedBy', 'openedDate', 'assignedTo', 'status');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->story->{$order}));
  }
  ?>
</div>
<script>
$(function()
{
    $('#<?php echo ($browseType == 'bymodule' and $this->session->storyBrowseType == 'bysearch') ? 'all' : $this->session->storyBrowseType;?>Tab').addClass('active');
})
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
