<?php
/**
 * The create view file of feedback module of ZenTaoPMS.
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
<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->feedback->create?></h2>
  </div>
  <form method='post' target='hiddenwin' enctype='multipart/form-data'>
    <table class='table table-form'>
      <tr>
        <th class='w-100px'><?php echo $lang->feedback->product?></th>
        <td><?php echo html::select('product', $products, '', "class='form-control chosen'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->feedback->title?></th>
        <td>
          <div class='input-group'>
            <?php echo html::input('title', '', "class='form-control'")?>
            <span class='input-group-addon'>
              <div class='checkbox-primary'>
                <input type='checkbox' id='public' name='public' value='1' />
                <label for='notify'><?php echo $lang->feedback->public?></label>
              </div>
            </span>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->feedback->desc?></th>
        <td><?php echo html::textarea('desc', '', "class='form-control'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->feedback->files;?></th>
        <td><?php echo $this->fetch('file', 'buildform');?></td>
      </tr>  
      <tr>
        <th><?php echo $lang->feedback->notify;?></th>
        <td>
          <div class='checkbox-primary'>
            <input type='checkbox' id='notify' name='notify' value='1' />
            <label for='notify'><?php echo $lang->feedback->mailNotify?></label>
          </div>
        </td>
      </tr>  
      <tr>
        <td colspan='2' class='text-center form-actions'>
          <?php echo html::submitButton();?>
          <?php echo html::backButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
