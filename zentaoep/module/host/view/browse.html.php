<?php
/**
 * The browse view file of host module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      pengjiangxiu <pengjiangxiu@cnezsoft.com>
 * @package     host
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('confirmDelete', $lang->host->confirmDelete)?>
<?php js::set('browseType', $browseType)?>
<div id='mainMenu' class='clearfix'>
  <div class='pull-left btn-toolbar'>
    <?php echo html::a(inlink('browse'), "<span class='text'>{$lang->host->all}</span>", '', "class='btn btn-link btn-active-text' id='allTab'")?>
    <?php echo html::a(inlink('treemap', "type=serverroom"), "<span class='text'>" . $lang->host->treemapList['serverroom'] . '</span>', '', "class='btn btn-link' id='serverroomTab'")?>
    <?php echo html::a(inlink('treemap', "type=group"), "<span class='text'>" . $lang->host->treemapList['group'] . '</span>', '', "class='btn btn-link' id='groupTab'")?>
    <a href='#' class='btn btn-link querybox-toggle' id='bysearchTab'><i class='icon-search icon'></i> <?php echo $lang->host->byQuery;?></a>
  </div>
  <?php if(common::hasPriv('host', 'create')):?>
  <div class="btn-toolbar pull-right" id='createActionMenu'>
    <?php
    $misc = "class='btn btn-primary'";
    $link = $this->createLink('host', 'create');
    echo html::a($link, "<i class='icon icon-plus'></i>" . $lang->host->create, '', $misc);
    ?>
  </div>
  <?php endif;?>
</div>
<div id='queryBox' class='cell <?php if($browseType =='bysearch') echo 'show';?>'></div>

<div id='mainContent' class='main-row'>
  <div class="side-col" id="sidebar">
    <div class="sidebar-toggle"><i class="icon icon-angle-left"></i></div>
    <div class='cell'>
      <div class='panel panel-sm'>
        <div class='panel-heading nobr'><strong><?php echo $lang->host->group;?></strong></div>
        <div class='panel-body'>
          <?php echo $moduleTree;?>
          <div class="text-center">
            <?php common::printLink('tree', 'browseHost', "moduleID=0", $lang->host->groupMaintenance, '', "class='btn btn-info btn-wide'");?>
            <hr class="space-sm" />
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class='main-col main-table' id='hostList'>
    <table class='table has-sort-head table-fixed'>
      <thead>
        <tr>
          <?php $vars = "browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
          <th class='w-60px'>   <?php common::printOrderLink('t1.id',     $orderBy, $vars, $lang->idAB);?></th>
          <th class='text-left'><?php common::printOrderLink('group',     $orderBy, $vars, $lang->host->group);?></th>
          <th class='text-left'><?php common::printOrderLink('name',      $orderBy, $vars, $lang->host->name);?></th>
          <th class='text-left'><?php common::printOrderLink('serverRoom',$orderBy, $vars, $lang->host->serverRoom);?></th>
          <th class='w-110px'>  <?php common::printOrderLink('privateIP', $orderBy, $vars, $lang->host->privateIP);?></th>
          <th class='w-110px'>  <?php common::printOrderLink('publicIP',  $orderBy, $vars, $lang->host->publicIP);?></th>
          <th class='w-90px'>   <?php common::printOrderLink('osVersion', $orderBy, $vars, $lang->host->osVersion);?></th>
          <th class='w-60px'>   <?php common::printOrderLink('status',    $orderBy, $vars, $lang->host->status);?></th>
          <th class='w-120px'>   <?php echo $lang->actions?></th>
        </tr>
      </thead>
      <?php if(!empty($hostList)):?>
      <tbody>
        <?php foreach($hostList as $host):?>
        <tr class='text-left'>
          <td><?php printf('%03d', $host->id);?></td>
          <td class='hidden-xs hidden-sm' title='<?php echo $optionMenu[$host->group];?>'><?php echo $optionMenu[$host->group];?></td>
          <td title='<?php echo $host->name?>'><?php echo html::a($this->inlink('view', "id=$host->id", 'html', true), $host->name, '', "class='iframe'");?></td>
          <?php $serverRoomName = zget($rooms, $host->serverRoom, "");?>
          <td title='<?php echo $serverRoomName?>'><?php echo $host->serverRoom ? html::a($this->createLink('serverroom', 'view', "id=$host->serverRoom", 'html', true), $serverRoomName, '', "class='iframe'") : ''?></td>
          <td><?php echo $host->privateIP;?></td>
          <td><?php echo $host->publicIP;?></td>
          <td class='hidden-xs hidden-sm'><?php echo $lang->host->{$host->osName.'List'}[$host->osVersion];?></td>
          <td class='hidden-xs hidden-sm'><?php echo $lang->host->statusList[$host->status];?></td>
          <td class='c-actions'>
            <?php
            $icon  = $host->status == 'offline' ? '<i class="icon icon-check-sign"></i>' : '<i class="icon icon-minus"></i>';
            $title = $host->status == 'offline' ? $lang->host->online : $lang->host->offline;
            if(common::hasPriv('host', 'changeStatus', $host)) echo html::a($this->inlink('changeStatus', "id=$host->id&hostID=$host->hostID&status=$host->status", 'html', true), $icon, '', "class='btn iframe' title='{$title}'");
    
            common::printIcon('host','edit',"id=$host->assetID&hostID=$host->hostID", $host, '', 'pencil');
            if(common::hasPriv('host', 'delete', $host)) 
            {
                $deleteURL = $this->createLink('host', 'delete', "id=$host->assetID&confirm=yes");
                echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"hostList\",confirmDelete)", '<i class="icon-trash"></i>', '', "class='btn' title='{$lang->host->delete}'");
            }
            ?>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
      <?php endif;?>
    </table>
    <?php if(!empty($hostList)):?>
    <div class='table-footer'><?php $pager->show('right', 'pagerjs');?></div>
    <?php endif;?>
  </div>
</div>
<script>
$(function()
{
    <?php if($browseType == 'bymodule'):?>
    $('#module<?php echo $param?>').closest('li').addClass('active');
    <?php endif;?>
    if(browseType == 'bysearch') $.toggleQueryBox(true);
})
</script>
<?php include '../../common/view/footer.html.php';?>
