<?php $effortHtml = $this->loadModel('effort')->createAppendLink('build', $build->id); ?>
<script>
$('#mainMenu .pull-right').prepend(<?php echo json_encode($effortHtml);?>);
$(function()
{
    $(".effort").addClass('btn-link').modalTrigger({width:1024, height:600, iframe:true, transition:'elastic'});
});
</script>
