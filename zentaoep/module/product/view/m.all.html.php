<?php
/**
 * The all mobile view file of product module of ZenTaoPMS.
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
  <?php echo html::a(inlink("all", "productID=$productID&status=noclosed"), $lang->product->unclosed, '', "id='noclosedTab'");?>
  <?php echo html::a(inlink("all", "productID=$productID&status=closed"), $lang->product->statusList['closed'], '', "id='closedTab'");?>
  <?php echo html::a(inlink("all", "productID=$productID&status=all"), $lang->product->allProduct, '', "id='allTab'");?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('product', 'all', http_build_query($this->app->getParams()));?>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->product->name;?></th>
          <th class='w-80px'><?php echo $lang->statusAB;?></th>
        </tr>
      </thead>
      <?php foreach($productStats as $product):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('product', 'browse', "product=$product->id")?>'>
        <td class='text-left'><?php echo $product->name;?></td>
        <td><?php echo zget($lang->product->statusList, $product->status);?></td>
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
  $vars = "productID=$productID&status=$status&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $sortOrders = array('id', 'name', 'order');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($order == 'id' ? 'ID' : $lang->product->{$order}));
  }
  ?>
</div>
<script>$("#<?php echo $status;?>Tab").addClass('active');</script>
<?php include '../../common/view/m.footer.html.php';?>
