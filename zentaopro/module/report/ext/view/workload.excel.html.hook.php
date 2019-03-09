<?php if(common::hasPriv('report', 'reportExport')):?>
<script>
$(function()
{
    var $link = $(<?php echo json_encode(html::a(inlink('reportExport', "type=workLoad&params=" . base64_encode("begin=$begin&end=$end&days=$days&workday=$workday&dept=$dept")), $lang->export, '', "class='iframe btn btn-primary btn-sm'"));?>).modalTrigger({iframe:true, transition:'elastic'});
    $('.main-col .cell .table-row:first .col-sm-1:first').css('padding-left', '0');
    $('.main-col .cell .panel .panel-heading .panel-actions').append($link);
})
</script>
<?php endif;?>
