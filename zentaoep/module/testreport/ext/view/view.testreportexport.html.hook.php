<?php if(common::hasPriv('testreport', 'export')):?>
<?php
$exportHtml  = "<div class='btn-toolbar pull-right'>";
$exportHtml .= html::a($this->createLink('testreport', 'export', "reportID={$report->id}"), "<i class='icon-export'></i> {$lang->testreport->export}", '', "class='btn btn-link export'");
$exportHtml .= "</div>";
?>
<script>
$(function()
{
    $('#mainMenu').append(<?php echo json_encode($exportHtml)?>);
    $(".export").modalTrigger({width:800, iframe:true, transition:'none'});
})
</script>
<?php endif;?>
