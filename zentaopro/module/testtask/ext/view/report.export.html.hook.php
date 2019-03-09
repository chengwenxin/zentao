<?php if(common::hasPriv('report', 'export')):?>
<script>
$(function()
{
    $('#mainMenu').prepend(<?php echo json_encode("<div class='btn-toolbar pull-right'>" . html::a($this->createLink('report', 'export', 'module=' . $this->app->getModuleName() . "&productID=$productID&taskID=$taskID"), $lang->export, '', "class='btn btn-primary' id='exportchart'") . '</div>')?>);
    $('#exportchart').modalTrigger();
});
</script>
<?php endif;?>
