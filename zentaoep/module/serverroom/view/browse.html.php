<?php
/**
 * The browse view file of serverRoom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Jiangxiu Peng <pengjiangxiu@cnezsoft.com>
 * @package     serverRoom
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('confirmDelete', $lang->serverroom->confirmDelete)?>
<?php js::set('browseType', $browseType)?>
<div id='mainMenu' class='clearfix'>
  <div class='pull-left btn-toolbar'>
    <?php echo html::a($this->createLink('serverroom', 'browse'), "<span class='text'>{$lang->serverroom->all}</span>", '', "class='btn btn-link btn-active-text'");?>
    <a href='#' id='bysearchTab' class='btn btn-link querybox-toggle'><i class='icon-search icon'></i>&nbsp;<?php echo $lang->serverroom->byQuery;?></a>
  </div>

  <?php if(common::hasPriv('serverroom', 'create')):?>
  <div class="btn-toolbar pull-right" id='createActionMenu'>
    <?php
    $misc = "class='btn btn-primary'";
    $link = $this->createLink('serverroom', 'create');
    echo html::a($link, "<i class='icon icon-plus'></i>" . $lang->serverroom->create, '', $misc);
    ?>
  </div>
  <?php endif;?>
</div>
<div id='queryBox' class='cell <?php if($browseType =='bysearch') echo 'show';?>'></div>
<div id='mainContent' class='main-table'>
  <table class='table has-sort-head' id='serverRoomList'>
    <thead>
      <?php $vars = "browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
      <tr>
        <th class='w-60px'> <?php common::printOrderLink('id',          $orderBy, $vars, $lang->idAB);?></th>
        <th>                <?php common::printOrderLink('name',        $orderBy, $vars, $lang->serverroom->name);?></th>
        <th class='w-100px'><?php common::printOrderLink('city',        $orderBy, $vars, $lang->serverroom->city);?></th>
        <th class='w-90px'> <?php common::printOrderLink('line',        $orderBy, $vars, $lang->serverroom->line);?></th>
        <th class='w-80px'> <?php common::printOrderLink('bandwidth',   $orderBy, $vars, $lang->serverroom->bandwidth);?></th>
        <th class='w-80px'> <?php common::printOrderLink('provider',    $orderBy, $vars, $lang->serverroom->provider);?></th>
        <th class='w-100px'><?php common::printOrderLink('owner',       $orderBy, $vars, $lang->serverroom->owner);?></th>
        <th class='w-100px'><?php common::printOrderLink('createdBy',   $orderBy, $vars, $lang->serverroom->createdBy);?></th>
        <th class='w-150px'><?php common::printOrderLink('createdDate', $orderBy, $vars, $lang->serverroom->createdDate);?></th>
        <th class='w-100px'><?php echo $lang->actions?></th>
      </tr>
    </thead>
    <?php if(!empty($serverRoomList)):?>
    <tbody>
      <?php foreach($serverRoomList as $serverRoom):?>
      <tr>
        <td><?php echo $serverRoom->id;?></td>
        <td title='<?php echo $serverRoom->name?>'><?php echo html::a($this->inlink('view', "id=$serverRoom->id", 'html', true), $serverRoom->name, '', "class='iframe'");?></td>
        <td><?php echo zget($lang->serverroom->cityList, $serverRoom->city)?></td>
        <td><?php echo zget($lang->serverroom->lineList, $serverRoom->line);?></td>
        <td><?php echo $serverRoom->bandwidth;?></td>
        <td><?php echo zget($lang->serverroom->providerList, $serverRoom->provider);?></td>
        <td><?php echo zget($users, $serverRoom->owner);?></td>
        <td><?php echo zget($users, $serverRoom->createdBy);?></td>
        <td><?php echo $serverRoom->createdDate;?></td>
        <td class='c-actions'>
          <?php
          common::printIcon('serverroom','edit',"id=$serverRoom->id", $serverRoom, '', 'pencil');
          if(common::hasPriv('serverroom', 'delete', $serverRoom))
          {
              $deleteURL = $this->createLink('serverroom', 'delete', "id=$serverRoom->id");
              echo html::a("javascript:ajaxDelete(\"$deleteURL\", \"mainContent\", confirmDelete)", '<i class="icon-trash"></i>', '', "class='btn' title='{$lang->serverroom->delete}'");
          }
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <?php endif;?>
  </table>
  <div class='table-footer'>
    <?php $pager->show('right', 'pagerjs');?>
  </div>
</div>
<script>
$(function()
{
    $('#<?php echo $browseType?>Tab').addClass('active');
    if(browseType == 'bysearch') $.toggleQueryBox(true);
})
</script>
<?php include '../../common/view/footer.html.php';?>
