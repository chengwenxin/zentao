<?php
/**
 * The create view file of serverRoom module of ZenTaoPMS.
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
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2>
      <span class='label label-id'><?php echo $serverRoom->id;?></span>
      <?php echo $serverRoom->name;?>
      <small><?php echo $lang->arrow . $lang->serverroom->edit?></small>
    </h2>
  </div>
  <form method='post' target='hiddenwin'>
    <table class='table table-form'>
      <tr>
        <th class='w-100px'><?php echo $lang->serverroom->name?></th>
        <td class='w-p25-f'><?php echo html::input('name', "$serverRoom->name", "class='form-control'")?></td>
        <td></td>
      </tr>
      <tr>
        <th><?php echo $lang->serverroom->city?></th>
        <td><?php echo html::select('city', $lang->serverroom->cityList, $serverRoom->city, "class='form-control chosen'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->serverroom->line?></th>
        <td><?php echo html::select('line', $lang->serverroom->lineList, "$serverRoom->line", "class='form-control chosen'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->serverroom->bandwidth?></th>
        <td><?php echo html::input('bandwidth', "$serverRoom->bandwidth", "class='form-control'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->serverroom->provider;?></th>
        <td><?php echo html::select('provider', $lang->serverroom->providerList, $serverRoom->provider, "class='form-control chosen'")?></td>
      </tr>  
      <tr>
        <th><?php echo $lang->serverroom->owner;?></th>
        <td><?php echo html::select('owner', $users, $serverRoom->owner, "class='form-control chosen'")?></td>
      </tr>  
      <tr>
        <td colspan='2' class='text-center form-actions'>
          <?php echo html::submitButton();?>
          <?php echo html::backButton('', '', 'btn btn-wide');?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
