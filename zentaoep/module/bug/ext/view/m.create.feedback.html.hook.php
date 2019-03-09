<?php if(isset($feedbackID)):?>
<?php $inputHtml = html::hidden('feedback', (int)$feedbackID) . html::hidden('found', $feedback->openedBy);?>
<script language='Javascript'>
$(function()
{
    $('#createForm').append(<?php echo json_encode($inputHtml)?>);
})
</script>
<?php endif;?>
