<?php
/**
 * The manage member view of group module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: managemember.html.php 4627 2013-04-10 05:42:20Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='center-block'>
    <div class='main-header'>
      <h2>
        <strong><?php echo empty($user->realname) ? $user->account : $user->realname;?></strong>
        <small class='text-muted'> <?php echo $lang->feedback->manageProduct;?></small>
      </h2>
    </div>
    <form class='main-form' method='post' target='hiddenwin'>
      <table class='table table-form'> 
        <?php $products = empty($feedbackProduct->products) ? array_keys($allProducts) : explode(',', $feedbackProduct->products);?>
        <tr>
          <th class='w-100px'>
            <div class="checkbox-primary checkbox-right check-all">
              <input type='checkbox' id='allCheckerGrantProduct' checked>
              <label class='text-right' for='allCheckerGrantProduct'><?php echo $lang->feedback->grantProduct;?></label>
            </div>
          </th>
          <td id='grantProduct'>
            <?php foreach($products as $productID):?>
            <div class='item'>
              <div class="checkbox-primary">
                <input name="products[]" value="<?php echo $productID;?>" checked="checked" id="products<?php echo $productID?>" type="checkbox" title="<?php echo $allProducts[$productID];?>">
                <label for="products<?php echo $productID?>"><?php echo $allProducts[$productID];?></label>
              </div>
            </div>
            <?php unset($allProducts[$productID]);?>
            <?php endforeach;?>
          </td>
        </tr>
        <?php if($allProducts):?>
        <tr>
          <th>
            <div class="checkbox-primary checkbox-right check-all">
              <input type='checkbox' id='allCheckerNoGrantProduct'>
              <label class='text-right' for='allCheckerNoGrantProduct'><?php echo $lang->feedback->noGrantProduct;?></label>
            </div>
          </th>
          <td id='noGrantProduct'>
            <?php foreach($allProducts as $productID => $productName):?>
            <div class='item'>
              <div class="checkbox-primary">
                <input name="products[]" value="<?php echo $productID;?>" id="products<?php echo $productID?>" type="checkbox" title="<?php echo $allProducts[$productID];?>">
                <label for="products<?php echo $productID?>"><?php echo $allProducts[$productID];?></label>
              </div>
            </div> 
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <tr>
        <td colspan='2' class='text-center form-actions'>
          <?php echo html::submitButton();?>
          <?php echo html::backButton();?>
        </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
