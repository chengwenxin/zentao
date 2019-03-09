<?php
/**
 * The browse mobile view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     bug
 * @version     $Id$
 * @link        http://www.zentao.net
 */

$featureMenu = $config->global->flow == 'full' ? customModel::getFeatureMenu($this->moduleName, $this->methodName) : array();
if($featureMenu) $bodyClass = 'with-menu-top';
?>
<?php include '../../common/view/m.header.html.php';?>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php foreach($featureMenu as $id => $menuItem):?>
    <?php if(isset($menuItem->hidden) || $menuItem->name == 'more') continue;?>
    <?php if(strpos($menuItem->name, 'QUERY') === 0) unset($featureMenu[$id]);?>
    <?php echo html::a(inlink('browse', "productID=$productID&branch=$branch&browseType={$menuItem->name}&param=0"), $menuItem->text, '', "id='{$menuItem->name}Tab'");?>
  <?php endforeach;?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
  <?php if(common::hasPriv('bug', 'create')):?>
  <nav class='nav'>
    <a class='btn primary' data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('bug', 'create', "productID=$productID&branch=$branch")?>'>
      <i class='icon icon-plus'></i> &nbsp;&nbsp;<?php echo $lang->bug->create;?>
    </a>
  </nav>
  <?php endif;?>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('bug', 'browse', "productID=$productID&branch=$branch&browseType=$browseType&param=$param&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}");?>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->bug->title;?></th>
          <th class='w-80px text-center'><?php echo $lang->bug->status;?></th>
        </tr>
      </thead>
      <?php foreach($bugs as $bug):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('bug', 'view', "bugID={$bug->id}")?>' data-id='<?php echo$bug->id;?>'>
        <td class='text-left'>
        <?php
        $class = 'confirm' . $bug->confirmed;
        echo "<span class='$class'>[{$lang->bug->confirmedList[$bug->confirmed]}]</span> ";
        if($bug->branch)echo "<span title='{$lang->product->branchName[$product->type]}' class='label label-branch label-badge'>{$branches[$bug->branch]}</span> ";
        if($modulePairs and $bug->module)echo "<span title='{$lang->bug->module}' class='label label-info label-badge'>{$modulePairs[$bug->module]}</span> ";
        ?>
        <?php echo "<span style='color:$bug->color'>" . $bug->title . '</span>';?>
        </td>
        <td class='bug-<?php echo $bug->status?>'><?php echo zget($lang->bug->statusList, $bug->status);?></td>
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
  $vars = "productID=$productID&branch=$branch&browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  $sortOrders = array('id', 'severity', 'pri', 'title', 'status', 'openedBy', 'openedDate', 'deadline', 'assignedTo', 'resolvedBy', 'resolution');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->bug->{$order}));
  }
  ?>
</div>
<script>
$(function()
{
    $('#<?php echo $browseType;?>Tab').addClass('active');
    <?php if($config->global->flow != 'full'):?>
    $('#appnav a').removeClass('active');
    $("#appnav a[href*='<?php echo $browseType?>']").addClass('active');
    <?php endif;?>
})
</script>
<?php include '../../common/view/m.footer.html.php';?>
