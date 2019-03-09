<?php if(common::hasPriv('report', 'reportExport')):?>
<script>
$(function()
{
    var $link = $(<?php echo json_encode(html::a(inlink('reportExport', "type=workAssignSummary&params=" . base64_encode("begin=$begin&end=$end&dept=$dept")), $lang->export, '', "class='iframe btn btn-primary btn-sm'"));?>).modalTrigger({iframe:true, transition:'elastic'});
    $('.main-col .cell .panel .panel-heading .panel-actions').append($link);
})
</script>
<?php endif;?>
