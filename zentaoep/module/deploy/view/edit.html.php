<?php
/**
 * The edit view file of deploy module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     deploy
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainContent' class='main-content'>
  <?php if(!helper::isAjaxRequest()):?>
  <div class='main-header'>
    <h2> <?php echo $lang->deploy->edit;?></h2>
    <div class='pull-right btn-toolbar'><?php echo html::backButton('', '', 'btn');?></div>
  </div>
  <?php endif;?>
  <form method='post' target='hiddenwin' action='<?php echo inlink('edit', "id=$deploy->id")?>'>
    <table class='table table-form'> 
      <tr>
        <th class='w-80px'><?php echo $lang->deploy->name;?></th>
        <td colspan='2'><?php echo html::input('name', $deploy->name, "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->desc;?></th>
        <td colspan='2'><?php echo html::textarea('desc', $deploy->desc, "rows='10' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->owner;?></th>
        <td class='w-p30'><?php echo html::select('owner', $users, $deploy->owner, "class='form-control chosen'");?></td><td></td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->lblBeginEnd;?></th>
        <td>
          <div class='input-group'>
            <?php echo html::input('begin', substr($deploy->begin, 0, 16), "class='form-control form-datetime' placeholder='{$lang->deploy->begin}'");?>
            <span class='input-group-addon fix-border'>~</span>
            <?php echo html::input('end', substr($deploy->end, 0, 16), "class='form-control form-datetime' placeholder='{$lang->deploy->end}'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->status;?></th>
        <td><?php echo html::select('status', $lang->deploy->statusList, $deploy->status, "class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->members;?></th>
        <td colspan='2'><?php echo html::select('members[]', $users, $deploy->members, "class='form-control chosen' multiple");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->deploy->lblProduct;?></th>
        <td colspan='2'>
          <?php if($deploy->products):?>
          <?php foreach($deploy->products as $deployProduct):?>
          <div class='table-row'>
            <div class='table-col productCol'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->deploy->product?></span>
                <?php echo html::select('product[]', $products, $deployProduct->product, "class='form-control chosen' onchange='loadRelease(this)'");?>
              </div>
            </div>
            <div class='table-col releaseCol'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->deploy->release?></span>
                <?php $releases = isset($releaseGroup[$deployProduct->product]) ? $releaseGroup[$deployProduct->product] : array(0 => '');?>
                <?php echo html::select('release[]', $releases, $deployProduct->release, "class='form-control chosen'");?>
              </div>
            </div>
            <div class='table-col packageCol'>
              <div class='input-group w-p100'>
                <span class='input-group-addon'><?php echo $lang->deploy->package?></span>
                <?php echo html::input('package[]', $deployProduct->package, "class='form-control'");?>
              </div>
            </div>
            <div class='table-col actionCol'>
              <div class='btn-group'>
                <?php echo html::commonButton("<i class='icon icon-plus'></i>", "onclick='addItem(this)'");?>
                <?php echo html::commonButton("<i class='icon icon-trash'></i>", "onclick='removeItem(this)'");?>
              </div>
            </div>
          </div>
          <?php endforeach;?>
          <?php else:?>
          <div class='table-row'>
            <div class='table-col productCol'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->deploy->product?></span>
                <?php echo html::select('product[]', $products, '', "class='form-control chosen' onchange='loadRelease(this)'");?>
              </div>
            </div>
            <div class='table-col releaseCol'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->deploy->release?></span>
                <?php echo html::select('release[]', array('' => ''), '', "class='form-control chosen'");?>
              </div>
            </div>
            <div class='table-col packageCol'>
              <div class='input-group w-p100'>
                <span class='input-group-addon'><?php echo $lang->deploy->package?></span>
                <?php echo html::input('package[]', '', "class='form-control'");?>
              </div>
            </div>
            <div class='table-col actionCol'>
              <div class='btn-group'>
                <?php echo html::commonButton("<i class='icon icon-plus'></i>", "onclick='addItem(this)'");?>
                <?php echo html::commonButton("<i class='icon icon-trash'></i>", "onclick='removeItem(this)'");?>
              </div>
            </div>
          </div>
          <?php endif;?>
        </td>
      </tr>
      <tr>
        <td colspan='3' class='text-center form-actions'>
          <?php echo html::submitButton();?>
          <?php echo html::backButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.modal.html.php';?>
