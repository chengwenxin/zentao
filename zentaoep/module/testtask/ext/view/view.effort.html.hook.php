<?php if(!isonlybody()):?>
<?php $effortHtml = $this->loadModel('effort')->createAppendLink('testtask', $task->id); ?>
<script>
$('#mainContent .main-actions:first .btn-toolbar .divider:first').after(<?php echo json_encode($effortHtml);?>);
$(function()
{
    $(".effort").modalTrigger({width:1024, height:600, iframe:true, transition:'elastic'});
});
</script>
<?php endif;?>
