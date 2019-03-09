<?php $ldapHtml = common::hasPriv('user', 'importLDAP') ? html::a($this->createLink('user', 'importLDAP'), $lang->user->importLDAP, '', "class='btn btn-info btn-wide'") : '';?>
<script language='Javascript'>
$(function()
{
    $('#sidebar .cell').append("<hr class='space-sm' /><div class='text-center'>" + <?php echo json_encode($ldapHtml)?> + '</div>');
})
</script>
