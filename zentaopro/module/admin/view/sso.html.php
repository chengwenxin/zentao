<?php
/**
 * The sso view file of admin module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php'; ?>
<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left"><?php common::printAdminSubMenu('sso');?></div>
</div>
<div id='mainContent' class='main-content'>
  <div class='center-block'>
    <div class='main-header'>
      <div class='heading'>
        <h4><?php echo $lang->admin->sso;?></h4>
      </div>
    </div>
    <form method='post' id='dataform'>
      <table class='table table-form'>
        <tr>
          <th class='rowhead w-120px'><?php echo $lang->sso->turnon; ?></th>
          <td><?php echo html::radio('turnon', $lang->sso->turnonList, $turnon);?></td>
        </tr>
        <tr>
          <th class='rowhead w-120px'><?php echo $lang->sso->redirect; ?></th>
          <td><?php echo html::radio('redirect', $lang->sso->turnonList, $redirect);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->sso->addr; ?></th>
          <td><?php echo html::input('addr', $addr, "class='form-control' placeholder='{$lang->sso->addrNotice}' autocomplete='off'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->sso->code; ?></th>
          <td><?php echo html::input('code', $code, "class='form-control' autocomplete='off'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->sso->key; ?></th>
          <td><?php echo html::input('key', $key, "class='form-control' autocomplete='off'");?></td>
        </tr>
        <tr>
          <td colspan='2' class='text-center form-actions'>
            <?php echo html::submitButton();?>
            <?php echo html::backButton();?>
          </td>
         </tr>
      </table>
    </form>
    <div class='alert alert-info mg-0'><?php echo $lang->sso->help?></div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
