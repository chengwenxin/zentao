<?php js::set('ditto', $lang->user->ditto);?>
<script>
$(function()
{
var index = $('#batchCreateForm table tbody tr:first').find('input[id^=account]').closest('td').index();
$('#batchCreateForm table thead tr:first th').eq(index).width('160');
$('#batchCreateForm table tbody tr').each(function(i)
{
    var $account = $(this).find('td input[id^=account]');
    $account.wrap("<div class='input-group'></div>");
    $account.after("<span class='input-group-addon'><label for='feedback" + i + "' title='<?php echo $lang->user->feedbackNotice?>'><input type='hidden' name='feedback[" + i + "]' value='0' /><input type='checkbox' id='feedback" + i + "' onchange='setFeedback(this)'/> <?php echo $lang->user->feedbackAB?></label></span>");
})
$('input[id^=feedback]').change();
});
</script>
