<?php $link = $this->createLink('task', 'export', "project=$projectID&orderBy={$type},{$storyOrder}&type=kanban");?>
<?php if(common::hasPriv('task', 'export')):?>
<script>
$(function()
{
    $('#mainMenu .btn-toolbar .export').attr('href', '<?php echo $link;?>');
})
</script>
<?php endif;?>
