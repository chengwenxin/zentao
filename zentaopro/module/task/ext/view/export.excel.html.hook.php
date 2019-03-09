<?php if($type == 'group'):?>
<script>
$(function()
{
    $('.main-form .table tr').addClass('hidden');
    $('.main-form .table tr:first').removeClass('hidden');
    $('.main-form .table tr:last').removeClass('hidden');
    $('.main-form .table #fileType').remove();
    $('.main-form .table #submit').after("<input type='hidden' name='fileType' id='fileType' value='<?php echo $type;?>' />");
    $('.main-form .table #submit').after("<input type='hidden' name='projectID' id='projectID' value='<?php echo $projectID;?>' />");
    $('.main-form .table #submit').after("<input type='hidden' name='orderBy' id='orderBy' value='<?php echo $orderBy;?>' />");
})
</script>
<?php endif;?>
