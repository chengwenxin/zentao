<?php if(common::hasPriv('report', 'reportExport')):?>
<script>
$(function()
{
    var $link = $(<?php echo json_encode(html::a(inlink('reportExport', "type=projectDeviation&params=" . base64_encode("begin=$begin&end=$end")), $lang->export, '', "class='iframe btn btn-primary btn-sm'"));?>).modalTrigger({iframe:true, transition:'elastic'});
    $('.main-col .cell .panel .panel-heading .panel-actions').append($link);
})
</script>
<?php endif;?>
