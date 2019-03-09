<?php
/**
 * The control file of effort module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     effort
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='center-block'>
    <div class='main-header'>
      <h2><?php echo $lang->effort->edit;?></h2>
    </div>
    <form method='post' target='hiddenwin'>
      <table class='table table-form'>
        <tr>
          <th class='w-80px'><?php echo $lang->effort->product;?></th>
          <td class='w-p45'><?php echo html::select('product[]', $products, $effort->product, 'class="form-control chosen" multiple');?></td><td></td>
        </tr>
        <tr>
          <th class='w-80px'><?php echo $lang->effort->project;?></th>
          <td class='w-p45'><?php echo html::select('project', $projects, $effort->project, 'class="form-control chosen"');?></td><td></td>
        </tr>
        <tr>
          <th class='w-80px'><?php echo $lang->effort->date;?></th>
          <td class='w-p45'><?php echo html::input('date', $effort->date, 'class="form-date form-control"');?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->effort->consumed;?></th>
          <td><?php echo html::input('consumed', $effort->consumed, 'class="form-control" autocomplete="off"');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->effort->left;?></th>
          <td><?php echo html::input('left', $effort->left, 'class="form-control" autocomplete="off"');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->effort->objectType;?></th>
          <td><?php echo html::select('objectType', $lang->effort->objectTypeList, $effort->objectType, 'class="form-control"');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->effort->objectID;?></th>
          <td><?php echo html::input('objectID', $effort->objectID, 'class="form-control" autocomplete="off"');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->effort->work;?></th>
          <td colspan='2'><?php echo html::input('work', $effort->work, "class='form-control'");?></td>
        </tr>
        <tr>
          <td colspan='3' class='text-center'>
            <?php echo html::submitButton('', "onclick='return checkTaskLeft(\"{$lang->effort->noticeFinish}\")'") . html::backButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include './footer.html.php';?>
