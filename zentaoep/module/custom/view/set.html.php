<?php
/**
 * The set view file of custom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Congzhi Chen <congzhi@cnezsoft.com>
 * @package     custom
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include 'header.html.php';?>
<?php
$itemRow = <<<EOT
  <tr class='text-center'>
    <td>
      <input type='text' class="form-control" autocomplete='off' value="" name="keys[]">
      <input type='hidden' value="0" name="systems[]">
    </td>
    <td>
      <input type='text' class="form-control" autocomplete='off' value="" name="values[]">
    </td>
    <td class='c-actions'>
      <a href="javascript:void(0)" class='btn btn-link' onclick="addItem(this)"><i class='icon-plus'></i></a>
      <a href="javascript:void(0)" class='btn btn-link' onclick="delItem(this)"><i class='icon-close'></i></a>
    </td>
  </tr>
EOT;
?>
<?php js::set('itemRow', $itemRow)?>
<?php js::set('module',  $module)?>
<?php js::set('field',   $field)?>
<div id='mainContent' class='main-row'>
  <div class='side-col' id='sidebar'>
    <div class='cell'>
      <div class='list-group'>
        <?php
        foreach($lang->custom->{$module}->fields as $key => $value)
        {
            echo html::a(inlink('set', "module=$module&field=$key"), $value, '', " id='{$key}Tab'");
        }
        ?>
      </div>
    </div>
  </div>
  <div class='main-col main-content'>
    <form class="load-indicator main-form form-ajax" method='post'>
      <div class='main-header'>
        <div class='heading'>
          <strong><?php echo $lang->custom->object[$module] . $lang->arrow . $lang->custom->$module->fields[$field]?></strong>
        </div>
      </div>
      <?php if(($module == 'story' or $module == 'testcase') and $field == 'review'):?>
      <table class='table table-form mw-800px'>
        <tr>
          <th class='w-80px'><?php echo $lang->custom->storyReview;?></th>
          <td><?php echo html::radio('needReview', $lang->custom->reviewList, $needReview);?></td>
          <td></td>
        </tr>
        <tr <?php if($needReview and $module == 'testcase') echo "class='hidden'"?>>
          <th><?php echo $lang->custom->forceReview;?></th>
          <td><?php echo html::select('forceReview[]', $users, $forceReview, "class='form-control chosen' multiple");?></td>
          <td style='width:300px'><?php printf($lang->custom->notice->forceReview, $lang->$module->common);?></td>
        </tr>
        <?php if($module == 'testcase'):?>
        <tr <?php if(!$needReview) echo "class='hidden'"?>>
          <th><?php echo $lang->custom->forceNotReview;?></th>
          <td><?php echo html::select('forceNotReview[]', $users, $forceNotReview, "class='form-control chosen' multiple");?></td>
          <td style='width:300px'><?php printf($lang->custom->notice->forceNotReview, $lang->$module->common);?></td>
        </tr>
        <?php endif;?>
        <tr>
          <td colspan='2' class='text-center'><?php echo html::submitButton();?></td>
        </tr>
      </table>
      <?php elseif($module == 'task' and $field == 'hours'):?>
      <table class='table table-form mw-600px'>
        <tr>
          <th class='w-150px'><?php echo $lang->custom->workingHours;?></th>
          <td><?php echo html::input('defaultWorkhours', $workhours, "class='form-control w-80px' autocomplete='off'");?></td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->custom->weekend;?></th>
          <td><?php echo html::radio('weekend', $lang->custom->weekendList, $weekend);?></td>
        </tr>
        <tr>
          <td colspan='2' class='text-center'><?php echo html::submitButton();?></td>
        </tr>
      </table>
      <?php elseif($module == 'bug' and $field == 'longlife'):?>
      <table class='table table-form mw-600px'>
        <tr>
          <th class='w-100px'><?php echo $lang->custom->bug->fields['longlife'];?></th>
          <td class='w-100px'>
            <div class='input-group'>
              <?php echo html::input('longlife', $longlife, "class='form-control' autocomplete='off'");?>
              <span class='input-group-addon'><?php echo $lang->day?></span>
            </div>
          </td>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
      <div class='alert alert-info alert-block'><?php echo $lang->custom->notice->longlife;?></div>
      <?php elseif($module == 'block' and $field == 'closed'):?>
      <table class='table table-form mw-600px'>
        <tr>
          <th class='w-100px'><?php echo $lang->custom->block->fields['closed'];?></th>
          <td><?php echo html::select('closed[]', $blockPairs, $closedBlock, "class='form-control chosen' multiple");?></td>
        </tr>
        <tr>
          <td colspan='2' class='text-center'><?php echo html::submitButton();?></td>
        </tr>
      </table>
      <?php elseif($module == 'user' and $field == 'deleted'):?>
      <table class='table table-form mw-600px'>
        <tr>
          <th class='w-150px'><?php echo $lang->custom->user->fields['deleted'];?></th>
          <td><?php echo html::radio('showDeleted', $lang->custom->deletedList, $showDeleted);?></td>
        </tr>
        <tr>
          <td></td>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
      <?php else:?>
      <table class='table table-form active-disabled table-condensed mw-600px'>
        <tr class='text-center'>
          <td class='w-120px'><strong><?php echo $lang->custom->key;?></strong></td>
          <td><strong><?php echo $lang->custom->value;?></strong></td>
          <?php if($canAdd):?><th class='w-90px'></th><?php endif;?>
        </tr>
        <?php foreach($fieldList as $key => $value):?>
        <tr class='text-center'>
          <?php $system = isset($dbFields[$key]) ? $dbFields[$key]->system : 1;?>
          <td><?php echo $key === '' ? 'NULL' : $key; echo html::hidden('keys[]', $key) . html::hidden('systems[]', $system);?></td>
          <td>
            <?php echo html::input("values[]", isset($dbFields[$key]) ? $dbFields[$key]->value : $value, "class='form-control' autocomplete='off' " . (empty($key) ? 'readonly' : ''));?>
          </td>
          <?php if($canAdd):?>
          <td class='c-actions'>
            <a href="javascript:void(0)" onclick="addItem(this)" class='btn btn-link'><i class='icon-plus'></i></a>
            <a href="javascript:void(0)" onclick="delItem(this)" class='btn btn-link'><i class='icon-close'></i></a>
          </td>
          <?php endif;?>
        </tr>
        <?php endforeach;?>
        <tr>
          <td colspan='<?php $canAdd ? print(3) : print(2);?>' class='text-center form-actions'>
          <?php
          $appliedTo = array($currentLang => $lang->custom->currentLang, 'all' => $lang->custom->allLang);
          echo html::radio('lang', $appliedTo, $lang2Set);
          echo html::submitButton();
          if(common::hasPriv('custom', 'restore')) echo html::linkButton($lang->custom->restore, inlink('restore', "module=$module&field=$field"), 'hiddenwin', '', 'btn btn-wide');
          ?>
          </td>
        </tr>
      </table>
      <?php if(!$canAdd):?>
      <div class='alert alert-warning alert-block'><?php echo $lang->custom->notice->canNotAdd;?></div>
      <?php endif;?>
      <?php endif;?>
    </form>
  </div>
</div>
<?php if($module == 'testcase' and $field == 'review'):?>
<script>
$(function()
{
    $("input[name='needReview']").change(function()
    {
        if($(this).val() == 0)
        {
            $('#forceReview').closest('tr').removeClass('hidden');
            $('#forceNotReview').closest('tr').addClass('hidden');
        }
        else
        {
            $('#forceReview').closest('tr').addClass('hidden');
            $('#forceNotReview').closest('tr').removeClass('hidden');
        }
    })
})
</script>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>
