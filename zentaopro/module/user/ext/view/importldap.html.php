<?php include '../../../common/view/header.html.php';?>
<style>
.main-table tbody>tr {background-color: #fff !important;}
</style>
<div id='mainContent'>
  <div class='main-header'>
    <h2><?php echo $lang->user->importLDAP?></h2>
  </div>
  <form class='main-table' id='ldapForm' target='hiddenwin' method='post' data-ride='table'>
    <table id='ldapList' class='table table-fixed active-disabled table-datatable'>
      <thead>
      <tr class='text-center'>
        <th class='w-130px text-left'>
          <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
            <label></label>
          </div>
          <?php echo $lang->user->id?>
        </th>
        <th class='w-200px text-left'><?php echo $lang->user->account?></th>
        <th class='w-100px text-left'><?php echo $lang->user->realname?></th>
        <th><?php echo $lang->user->link?></th>
        <th><?php echo $lang->user->dept?></th>
        <th><?php echo $lang->user->role?></th>
        <th><?php echo $lang->user->group?></th>
        <th class='w-90px'><?php echo $lang->user->gender?></th>
        <th class='w-150px'><?php echo $lang->user->qq?></th>
      </tr>
      </thead>
      <tbody>
      <?php $inputVars = 0;?>
      <?php foreach($users as $i => $user):?>
      <tr>
        <td class='c-id'>
          <div class='checkbox-primary'>
            <input type='checkbox' name='add[<?php echo $i?>]' value='<?php echo $i?>'>
            <label></label>
          </div>
          <?php printf("%03d", $i + 1)?>
        </td>
        <td><?php echo $user['account'] . html::hidden("account[$i]", $user['account'])?></td>
        <td><?php echo $user['realname'];?></td>
        <td style='overflow:visible'><?php echo html::select("link[$i]", $localUsers, '', 'class="form-control chosen"');?></td>
        <td class='text-left' style='overflow:visible'><?php echo html::select("dept[$i]", $depts, $i == 0 ? '' : 'ditto', 'class="form-control chosen"')?></td>
        <td><?php echo html::select("role[$i]",   $roles,   $i == 0 ? '' : 'ditto', 'class="form-control"')?></td>
        <td><?php echo html::select("group[$i]",  $groups,  $i == 0 ? $defaultGroup : 'ditto', 'class="form-control"')?></td>
        <td><?php echo html::select("gender[$i]", $genders, $i == 0 ? '' : 'ditto', 'class="form-control"')?></td>
        <td><?php echo html::input("qq[$i]", '', 'class="form-control"')?></td>
      </tr>
      <?php $inputVars += 6;?>
      <?php endforeach;?>
      </tbody>
    </table>
    <?php if($users):?>
    <div class='table-footer'>
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class='table-actions btn-toolbar'><?php echo html::submitButton($lang->save, '', 'btn btn-primary');?></div>
      <span style='padding-left:5px;'><?php echo html::backButton('', '', 'btn') . '&nbsp;&nbsp;' . $lang->user->notice->checkbox?></span>
      <?php $pager->show('right', 'pagerjs');?>
    </div>
    <?php endif;?>
  </form>
</div>
<script>
<?php if(common::judgeSuhosinSetting($inputVars)):?>
$(function()
{
    $('.table-footer').before("<div class='alert alert-info'><?php echo  extension_loaded('suhosin') ? trim(sprintf($lang->suhosinInfo, $inputVars)) : trim(sprintf($lang->maxVarsInfo, $inputVars));?></div>")
})
<?php endif;?>
</script>
<?php include '../../../common/view/footer.html.php';?>
