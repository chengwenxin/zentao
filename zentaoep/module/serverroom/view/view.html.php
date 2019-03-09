<?php
/**
 * The view view file of serverroom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     serverroom
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->serverroom->view;?></h2>
  </div>
  <div class='main'>
    <div class='detail'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->serverroom->name;?></th>
          <td class='w-p25-f'><?php echo $serverRoom->name;?></td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->serverroom->city;?></th>
          <td><?php echo zget($lang->serverroom->cityList, $serverRoom->city)?></td>
        </tr>
        <tr>
          <th><?php echo $lang->serverroom->line;?></th>
          <td><?php echo zget($lang->serverroom->lineList, $serverRoom->line);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->serverroom->bandwidth;?></th>
          <td><?php echo $serverRoom->bandwidth;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->serverroom->provider;?></th>
          <td><?php echo zget($lang->serverroom->providerList, $serverRoom->provider);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->serverroom->owner;?></th>
          <td><?php echo zget($users, $serverRoom->owner);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->serverroom->createdBy;?></th>
          <td><?php echo zget($users, $serverRoom->createdBy);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->serverroom->createdDate;?></th>
          <td><?php echo $serverRoom->createdDate;?></td>
        </tr>  
      </table>
    </div>
    <?php include '../../common/view/action.html.php'?>
  </div>
  <div id='mainActions' class='main-actions'>
    <nav class='container'></nav>
    <div class='btn-toolbar'>
      <?php
      common::printLink('serverroom', 'edit', "id=$serverRoom->id", "<i class='icon-pencil'></i> " . $lang->edit, '', "class='btn'", '', '', $serverRoom);
      common::printLink('serverroom', 'delete', "id=$serverRoom->id", "<i class='icon-trash'></i> " . $lang->delete, 'hiddenwin', "class='btn'", '', '', $serverRoom);
      if(!isonlybody()) common::printLink('serverroom', 'browse', "", "<i class='icon-goback icon-back'></i> " . $lang->goback, '', "class='btn'");
      ?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
