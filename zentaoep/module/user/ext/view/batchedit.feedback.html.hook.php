<?php js::set('ditto', $lang->user->ditto);?>
<script>
$(function()
{
    var index = $('#batchCreateForm table tbody tr:first').find('input[id^=account]').closest('td').index();
    $('#batchCreateForm table thead tr:first th').eq(index).width('200');
    <?php foreach($users as $user):?>
    $account = $('#batchCreateForm table tbody tr').find('input[id="account[<?php echo $user->id?>]"]');
    $account.wrap("<div class='input-group'></div>");
    $account.after("<span class='input-group-addon'><label for='feedback<?php echo $user->id?>' title='<?php echo $lang->user->feedbackNotice?>'><input type='hidden' name='feedback[<?php echo $user->id?>]' value='<?php echo $user->feedback?>' /><input type='checkbox' id='feedback<?php echo $user->id?>' <?php if($user->feedback) echo 'checked'?> onchange='setFeedback(this)'/> <?php echo $lang->user->feedbackAB?></label></span>");
    <?php endforeach;?>
});
</script>
