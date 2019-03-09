<?php
/**
 * The admin view file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     feedback
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='mainContent' class='main-table'>
  <table class='table table-fixed tablesorter table-datatable'>
    <thead>
      <tr>
        <th class='w-80px'> <?php echo $lang->user->account;?></th>
        <th><?php echo $lang->feedback->products;?></th>
        <th class='w-60px c-actions text-center'><?php echo $lang->actions?></th>
      </tr>
    </thead>
    <?php if($users):?>
    <tbody>
      <?php foreach($users as $account => $realname):?>
      <tr class='text-center'>
        <td><?php echo empty($realname) ? $account : $realname;?></td>
        <td class='text-left'>
          <?php
          if(empty($feedbackProducts[$account]))
          {
              echo $lang->feedback->allProduct;
          }
          else
          {
              foreach(explode(',', $feedbackProducts[$account]) as $productID)
              {
                  if(isset($allProducts[$productID])) echo $allProducts[$productID] . ' ';
              }
          }
          ?>
        </td>
        <td class='c-actions'>
          <?php common::printLink('feedback', 'manageProduct', "account=$account", "<i class='icon icon-link'></i>", '', "class='iframe btn' title='{$lang->feedback->manageProduct}'", '', true);?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <?php endif;?>
  </table>
  <div class='table-footer'><?php $pager->show('right', 'pagerjs');?></div>
</div>
<?php include '../../common/view/footer.html.php';?>
