<?php if(!isonlybody()):?>
<?php 
$this->app->loadlang('effort');
$effortHtml = $this->loadModel('effort')->createAppendLink('todo', $todo->id);
?>
<script>
$(function()
{
    $('#mainContent .main-actions:first .btn-toolbar').prepend(<?php echo json_encode($effortHtml);?>);
    $(".effort").modalTrigger({width:1024, iframe:true, transition:'elastic'});
})
</script>
<?php endif;?>
