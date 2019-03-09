<?php if(!empty($app->user) and common::hasPriv('todo', 'calendar')):?>
<script>
$(function()
{
    $('#mainMenu .btn-toolbar:first').prepend(<?php echo json_encode(html::a($this->createLink('todo', 'calendar'), '<i class="icon icon-back icon-sm"></i> ' . $lang->goback, '', "class='btn btn-link'") . '<div class="divider"></div>')?>)
})
</script>
<?php endif;?>
