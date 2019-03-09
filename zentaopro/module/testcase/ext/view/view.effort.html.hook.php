<?php $effortHtml = $this->loadModel('effort')->createAppendLink('case', $case->id); ?>
<script>
$('#mainContent .main-actions:first .btn-toolbar .divider:first').after(<?php echo json_encode($effortHtml);?>);
$(function()
{
    $(".effort").modalTrigger({width:1024, iframe:true, transition:'elastic'});
})
</script>
