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
<form class="modal-content load-indicator" method='post' target='hiddenwin' id="effortBatchAddForm">
  <div class="modal-header" id="effortBatchAddHeader">
    <div class="modal-actions">
      <?php echo html::commonButton($lang->effort->clean, "onclick='cleanEffort()' title='{$lang->effort->noticeClean}'")?>
      <?php if(isonlybody()):?>
      <div class="divider"></div>
      <button id='closeModal' type="button" class="btn btn-link" data-dismiss="modal"><i class="icon icon-close"></i></button>
      <?php endif;?>
    </div>
    <h4 class="modal-title pull-left"><?php echo $lang->effort->batchCreate;?></h4>
    <div class="input-group pull-left">
      <span class="input-group-addon"><?php echo $lang->effort->date;?></span>
      <input type="text" name="date" value="<?php echo $date;?>" class="form-control form-date" autocomplete="off" />
    </div>
  </div>

  <div class='modal-body'>
    <table class='table table-form' id='objectTable'>
      <thead>
        <tr>
          <th class='col-id'><?php echo $lang->idAB;?></th>
          <th class='col-work'><?php echo $lang->effort->work;?></th>
          <th class='col-objectType'><?php echo $lang->effort->objectType;?></th>
          <th class='col-project'><?php echo $lang->effort->project;?></th>
          <th class='col-left'><?php echo $lang->effort->left . '(' . $lang->effort->hour . ')';?></th>
          <th class='col-consumed'><?php echo $lang->effort->consumed . '(' . $lang->effort->hour . ')';?></th>
          <th class='col-actions'></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;?>
        <?php foreach($actions as $action):?>
        <tr class="effortBox computed">
          <td class="col-id"><?php echo '<span class="effortID">' . $i . '</span>' . html::hidden("id[]", $i);?></td>
          <td><?php echo html::input("work[]", $action->work, 'class="form-control" ' . (empty($action->work) ? '' : 'tabindex="9999"'));?></td>
          <td style='overflow:visible'>
            <?php
            echo html::select("objectType[]", $typeList, "{$action->objectType}_{$action->objectID}", "class='form-control chosen' tabindex='9999'");
            echo html::hidden("actionID[]", $action->id);
            ?>
          </td>
          <td style='overflow:visible'>
            <?php echo html::select("project[]", $projects, $action->project, "class='form-control chosen' tabindex='9999'");?>
          </td>
          <td>
            <?php
            $disabled = $action->objectType == 'task' ? '' : 'disabled';
            echo html::input("left[$i]", '', "autocomplete='off' class='form-control $disabled' " . $disabled);
            ?>
          </td>
          <td><?php echo html::input("consumed[]", '', 'autocomplete="off" class="form-control"');?></td>
          <td align='center'>
            <a href='javascript:;' onclick='addEffort(this)' tabindex="9999" class='btn btn-link btn-add'><i class="icon icon-plus"></i></a>
            <a href='javascript:;' onclick='deleteEffort(this)' tabindex="9999" class='btn btn-link btn-delete'><i class="icon icon-close"></i></a>
          </td>
        </tr>
        <?php $i++;?>
        <?php endforeach;?>
        <?php for($j = 0; $j < 8; $j++, $i++):?>
        <tr class="effortBox new">
          <td class="col-id"><?php echo '<span class="effortID">' . $i . '</span>' . html::hidden("id[]", $i);?></td>
          <td><?php echo html::input("work[]", '', 'class=form-control');?></td>
          <td style='overflow:visible'><?php echo html::select("objectType[]", $typeList, 'custom', "tabindex='9999' class='form-control chosen'");?></td> 
          <td style='overflow:visible'><?php echo html::select("project[]", $projects, 0, "tabindex='9999' class='form-control chosen'");?></td> 
          <td><?php echo html::input("left[$i]", '', 'autocomplete="off" class="form-control"');?></td>
          <td><?php echo html::input("consumed[]", '', 'autocomplete="off" class="form-control"');?></td>
          <td align='center'>
            <a href='javascript:;' onclick='addEffort(this)' tabindex="9999" class='btn btn-link btn-add'><i class="icon icon-plus"></i></a>
            <a href='javascript:;' onclick='deleteEffort(this)' tabindex="9999" class='btn btn-link btn-delete'><i class="icon icon-close"></i></a>
          </td>
        </tr>
        <?php endfor;?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan='7' class='text-center'>
            <?php echo html::submitButton() . html::backButton();?>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</form>
<?php js::set('num', $i)?>
<?php js::set('projectTask', $projectTask);?>
<?php if(isonlybody()):?>
<script>
$(function()
{
    parent.$('.modal-header').hide();
    parent.$('.modal-body').css('padding', '0px');
    $('#closeModal').click(function(){parent.$.closeModal();});
    $(".form-date").datetimepicker('setEndDate', '<?php echo date(DT_DATE1)?>');
})
</script>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>
