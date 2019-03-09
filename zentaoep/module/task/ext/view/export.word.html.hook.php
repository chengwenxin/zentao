<?php if($type == 'tree' or $type == 'calendar' or $type == 'kanban'):?>
<?php
$this->session->set('taskOnlyCondition', false);
$this->session->set('taskQueryCondition', false);
?>
<script>
$(function()
{
    $('.main-form .table tr').addClass('hidden');
    $('.main-form .table tr:first').removeClass('hidden');
    $('.main-form .table tr:last').removeClass('hidden');
    $('.main-form .table #fileType').remove();
    $('.main-form .table #submit').after("<input type='hidden' name='fileType' id='fileType' value='<?php echo $type;?>' />");
    $('.main-form .table #submit').after("<input type='hidden' name='projectID' id='projectID' value='<?php echo $projectID;?>' />");
    <?php if($type == 'kanban'):?>
    <?php list($kanbanType, $orderBy) = explode(',', $orderBy);?>
    $('.main-form .table #submit').after("<input type='hidden' name='type' id='type' value='<?php echo $kanbanType;?>' />");
    $('.main-form .table #submit').after("<input type='hidden' name='orderBy' id='orderBy' value='<?php echo $orderBy;?>' />");
    <?php endif;?>
})
</script>
<?php endif;?>
