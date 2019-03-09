<?php
/**
 * The createForObject mobile view file of effort module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     effort
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$this->session->set('effortList', $this->createLink($objectType, 'view', "id=$objectID"));
?>
<div class='heading divider'>
  <div class='title'><strong><?php echo $lang->effort->index;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>
<form class='content box' method='post' action='<?php echo $this->createLink('effort', 'createForObject', "objectType=$objectType&objectID=$objectID");?>' target='hiddenwin' id='createForObjectForm' data-form-refresh='#page'>
  <?php if($efforts):?>
  <table class='table bordered'>
    <tr>
      <th><?php echo $lang->effort->date?></th>
      <th><?php echo $lang->effort->consumedAB?></th>
      <?php if($objectType == 'task'):?>
      <th><?php echo $lang->effort->leftAB?></th>
      <?php endif;?>
      <th><?php echo $lang->effort->account?></th>
      <th><?php echo $lang->effort->work?></th>
      <th><?php echo $lang->actions;?></th>
    </tr>
    <?php foreach($efforts as $effort):?>
    <tr>
      <td><?php echo substr($effort->date, 5);?></td>
      <td><?php echo $effort->consumed;?></td>
      <?php if($objectType == 'task'):?>
      <td><?php echo $effort->left;?></td>
      <?php endif;?>
      <td><?php echo zget($users, $effort->account);?></td>
      <td><?php echo $effort->work;?></td>
      <td>
        <?php
        common::printIcon('effort', 'edit', "effortID=$effort->id", '', 'button', '', '', '', false, "style='padding:2px 5px' data-display='modal' data-placement='bottom'", "<i class='icon-pencil'></i>");
        if(common::hasPriv('effort', 'delete')) echo html::a($this->createLink('effort', 'delete', "effortID=$effort->id"), "<i class='icon-remove'></i>", 'hiddenwin', "style='padding:2px 5px'");
        ?>
      </td>
    </tr>
    <?php endforeach;?>
  </table>
  <?php endif;?>
  <a class="btn fluid" data-display data-target='#createEffort' data-trigger-method='toggle'><i class='icon-plus'></i> <?php echo $lang->effort->create?></a>
  <div id='createEffort' class='box fade hidden'>
    <div class='control'>
      <label for='date'><?php echo $lang->effort->date?></label>
      <input type='date' name='dates[]' value='<?php echo date(DT_DATE1)?>' class='input' />
    </div>
    <div class='row'>
      <div class='cell-6'>
        <div class='control'>
          <label for='consumed'><?php echo $lang->effort->consumed?></label>
          <input type='number' name='consumed[]' value='' class='input' />
        </div>
      </div>
      <div class='cell-6'>
        <div class='control'>
          <label for='left'><?php echo $lang->effort->left?></label>
          <input type='number' name='left[]' value='' class='input' />
        </div>
      </div>
    </div>
    <div class='control'>
      <label for='work'><?php echo $lang->effort->work?></label>
      <?php
      echo html::input('work[]', '', "class='input'");
      echo html::hidden("objectType[]", $objectType); 
      echo html::hidden("objectID[]", $objectID); 
      echo html::hidden("id[]", 0); 
      ?>
    </div>
    <div class='control'>
      <button type='submit' class='btn primary' onclick="return checkTaskLeft(\"<?php echo $lang->effort->noticeFinish;?>\")"><?php echo $lang->save;?></button>
    </div>
  </div>
</form>

<?php if(isset($pageJS)) js::execute($pageJS)?>
