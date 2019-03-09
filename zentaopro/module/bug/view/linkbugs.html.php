<?php
/**
 * The link bug view of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     bug
 * @version     $Id: linkbugs.html.php 4129 2016-03-08 09:00:12Z chenfei $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2>
      <span class='label label-id'><?php echo $bug->id;?></span>
      <?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id"), $bug->title, '_blank', "title='$bug->title'");?>
      <small class='text-muted'> <?php echo $lang->arrow . $lang->bug->linkBugs;?></small>
    </h2>
  </div>
  <div id='queryBox' class='show divider'></div>
  <?php if($bugs2Link):?>
  <form class='main-table' method='post' data-ride='table' target='hiddenwin' id='linkBugsForm'>
    <table class='table tablesorter' id='bugList'>
      <thead>
        <tr>
          <th class="c-id">
            <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
              <label></label>
            </div>
            <?php echo $lang->idAB;?>
          </th>
          <th class='c-pri'><?php echo $lang->priAB;?></th>
          <th><?php echo $lang->bug->product;?></th>
          <th><?php echo $lang->bug->title;?></th>
          <th class='w-status'><?php echo $lang->bug->statusAB;?></th>
          <th class='w-100px'><?php echo $lang->openedByAB;?></th>
          <th class='w-100px'><?php echo $lang->assignedToAB;?></th>
        </tr>
      </thead>
      <tbody>
        <?php $bugCount = 0;?>
        <?php foreach($bugs2Link as $bug2Link):?>
        <?php $bugLink = $this->createLink('bug', 'view', "bugID=$bug2Link->id");?>
        <tr>
          <td class='c-id'>
            <div class="checkbox-primary">
              <input type='checkbox' name='bugs[]'  value='<?php echo $bug2Link->id;?>'/> 
              <label></label>
            </div>
            <?php printf('%03d', $bug2Link->id);?>
          </td>
          <td><span class='label-pri <?php echo 'label-pri-' . $bug2Link->pri?>' title='<?php echo zget($lang->bug->priList, $bug2Link->pri, $bug2Link->pri);?>'><?php echo zget($lang->bug->priList, $bug2Link->pri, $bug2Link->pri);?></span></td>
          <td><?php echo html::a($this->createLink('product', 'browse', "productID=$bug2Link->product&branch=$bug2Link->branch"), $products[$bug2Link->product], '_blank');?></td>
          <td class='text-left nobr' title="<?php echo $bug2Link->title?>"><?php echo html::a($bugLink, $bug2Link->title);?></td>
          <td><?php echo zget($lang->bug->statusList, $bug->status, '');?></td>
          <td><?php echo zget($users, $bug2Link->openedBy);?></td>
          <td><?php echo zget($users, $bug2Link->assignedTo);?></td>
        </tr>
        <?php $bugCount ++;?>
        <?php endforeach;?>
      </tbody>
    </table>
    <div class='table-footer'>
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class="table-actions btn-toolbar"><?php if($bugCount) echo html::submitButton('', '', 'btn btn-default');?></div>
      <?php echo html::hidden('bug', $bug->id);?>
    </div>
  </form>
  <?php endif;?>
</div>
<script>
$(function()
{
    <?php if($bugs2Link):?>
    $('#linkBugsForm').table();
    setTimeout(function(){$('#linkBugsForm .table-footer').removeClass('fixed-footer');}, 100);
    <?php endif;?>

    $('#submit').click(function(){
        var output = '';
        $('#linkBugsForm').find('tr.checked').each(function(){
            var bugID    = $(this).find('td.c-id').find('div.checkbox-primary input').attr('value');
            var bugTitle = "#" + bugID + ' ' + $(this).find('td').eq(3).attr('title');
            var checkbox  = "<li><div class='checkbox-primary'><input type='checkbox' checked='checked' name='linkBug[]' " + "value=" + bugID + " /><label>" + bugTitle + "</label></div></li>";

            output += checkbox;
        });
        $.closeModal();
        parent.$('#linkBugsBox').html(output);
        return false;
    });
});
</script>
<?php include '../../common/view/footer.html.php';?>
