<?php
/**
 * The view view file of host module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     host
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->host->view;?></h2>
  </div>
  <div class='main'>
    <div class='detail'>
      <table class='table table-striped'>
        <tr>
          <th class='w-90px'><?php echo $lang->host->name;?></th>
          <td><?php echo $host->name;?></td>
          <th class='w-100px'></th><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->host->group;?></th>
          <td><?php echo $optionMenu[$host->group];?></td>
          <th><?php echo $lang->host->serverRoom;?></th>
          <td><?php echo zget($rooms, $host->serverRoom, "")?></td>
        </tr>
        <tr>
          <th><?php echo $lang->host->serverModel;?></th>
          <td><?php echo $host->serverModel;?></td>
          <th><?php echo $lang->host->hostType;?></th>
          <td><?php echo $lang->host->hostTypeList[$host->hostType];?></td>
        </tr>
        <tr>
          <th><?php echo $lang->host->cpuBrand;?></th>
          <td><?php echo $host->cpuBrand;?></td>
          <th><?php echo $lang->host->cpuModel;?></th>
          <td><?php echo $host->cpuModel;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->host->cpuNumber;?></th>
          <td><?php echo $host->cpuNumber;?></td>
          <th><?php echo $lang->host->cpuCores;?></th>
          <td><?php echo $host->cpuCores;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->host->memory;?></th>
          <td><?php if($host->memory) echo $host->memory . ' GB';?></td>
          <th><?php echo $lang->host->diskSize;?></th>
          <td><?php if($host->diskSize) echo $host->diskSize . ' GB';?></td>
        </tr>
        <tr>
          <th><?php echo $lang->host->privateIP;?></th>
          <td><?php echo $host->privateIP;?></td>
          <th><?php echo $lang->host->publicIP;?></th>
          <td><?php echo $host->publicIP;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->host->osName;?></th>
          <td><?php echo $host->osName;?></td>
          <th><?php echo $lang->host->osVersion;?></th>
          <td><?php echo $lang->host->{$host->osName.'List'}[$host->osVersion];?>
        </tr>
        <tr>
          <th><?php echo $lang->host->status;?></th>
          <td colspan='3'><?php echo $lang->host->statusList[$host->status];?></td>
        </tr>
      </table>
    </div>
    <?php include '../../common/view/action.html.php'?>
  </div>
  <div id='mainActions' class='main-actions'>
    <nav class='container'></nav>
    <div class='btn-toolbar'>
      <?php
      common::printLink('host', 'edit', "id=$host->assetID&hostID=$host->hostID", "<i class='icon-pencil'></i> " . $lang->edit, '', "class='btn'", '', '', $host);
      common::printLink('host', 'delete', "id=$host->assetID", "<i class='icon-trash'></i> " . $lang->delete, 'hiddenwin', "class='btn'", '', '', $host);
      if(!isonlybody()) common::printLink('host', 'browse', "", "<i class='icon-goback icon-back'></i> " . $lang->goback, '', "class='btn'");
      ?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
