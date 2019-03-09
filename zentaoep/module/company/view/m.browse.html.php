<?php
/**
 * The user browse mobile view file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     company
 * @version     $Id
 * @link        http://www.zentao.net
 */
?>

<?php include "../../common/view/m.header.html.php";?>

<style>
tbody > tr > td{word-break:break-all;}
</style>
<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('company', 'browse', "param=$param&type=$type&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}");?>
  <div class='box' data-page='<?php echo $pager->pageID;?>' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->user->realname;?> </th>
          <th><?php echo $lang->user->account;?> </th>
          <th class='text-center w-80px'><?php echo $lang->user->role;?> </th>
        </tr>
      </thead>
      <?php foreach($users as $user):?>
      <?php $isFeedback = !empty($_SESSION['user']->feedback) or !empty($_COOKIE['feedbackView']);?>
      <tr class='text-center' data-url='<?php if(!$isFeedback and common::hasPriv('user', 'view')) echo $this->createLink('user', 'view', "account={$user->account}")?>' data-id='<?php echo $user->id;?>'>
        <td class='text-left'><?php echo $user->realname;?></td>
        <td class='text-left'><?php echo $user->account;?></td>
        <td><?php echo zget($lang->user->roleList, $user->role);?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "param=$param&type=$type&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $sortOrders = array('id', 'realname', 'account', 'role', 'email', 'gender', 'phone', 'qq', 'join', 'last', 'visits');
  foreach($sortOrders as $sortOrder)
  {
      commonModel::printOrderLink($sortOrder, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->user->{$sortOrder});
  }
  ?>
</div>

<?php include "../../common/view/m.footer.html.php"; ?>
