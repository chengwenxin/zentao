<?php $effortHtml = $this->loadModel('effort')->createAppendLink('release', $release->id); ?>
<script>
$('#mainMenu .pull-right').prepend(<?php echo json_encode($effortHtml);?>);
$(function()
{
    $(".effort").addClass('btn-link').modalTrigger({iframe:true});
});
</script>
