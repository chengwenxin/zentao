<?php
/**
 * The browse mobile view file of productplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     productplan
 * @version     $Id$
 * @link        http://www.zentao.net
 */

$featureMenu = customModel::getFeatureMenu($this->moduleName, $this->methodName);
if($featureMenu) $bodyClass = 'with-menu-top';
?>
<?php include '../../common/view/m.header.html.php';?>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php foreach($featureMenu as $menuItem):?>
    <?php if(isset($menuItem->hidden)) continue;?>
    <?php echo html::a($this->inlink('browse', "productID=$productID&branch=$branch&browseType={$menuItem->name}"), $menuItem->text, '', "id='{$menuItem->name}Tab'");?>
  <?php endforeach;?>
</nav>
<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>
<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('productplan', 'browse', "productID=$productID&branch=$branch&browseType=$browseType&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}");?>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->productplan->title;?></th>
          <th class='w-100px'><?php echo $lang->productplan->begin;?></th>
          <th class='w-100px'><?php echo $lang->productplan->end;?></th>
        </tr>
      </thead>
      <?php foreach($plans as $plan):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('productplan', 'view', "planID={$plan->id}")?>' data-id='<?php echo$plan->id;?>'>
        <td class='text-left'>
        <?php if($this->session->currentProductType != 'normal') echo "<span class='label label-branch label-badge'>{$branches[$plan->branch]}</span>"?>
        <?php echo $plan->title;?>
        </td>
        <td><?php echo $plan->begin;?></td>
        <td><?php echo $plan->end;?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <nav class='nav justified pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "productID=$productID&branch=$branch&browseType=$browseType&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  $sortOrders = array('id', 'title', 'begin', 'end');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->productplan->{$order}));
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
