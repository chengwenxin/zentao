<?php
$class = common::hasPriv('task', 'exportTemplet') ? '' : "class='disabled'";
$link  = common::hasPriv('task', 'exportTemplet') ? $this->createLink('task', 'exportTemplet', "project=$projectID") : '#';
$misc  = common::hasPriv('task', 'exportTemplet') ? "class='exportTemplet'" : "class='disabled'";
$exportHtml = "<li $class>" . html::a($link, $lang->task->exportTemplet, '', $misc) . '</li>';

$class = common::hasPriv('task', 'import') ? '' : "class='disabled'";
$link  = common::hasPriv('task', 'import') ? $this->createLink('task', 'import', "project=$projectID") : '#';
$misc  = common::hasPriv('task', 'import') ? "class='importExcel'" : "class='disabled'";
$importHtml = "<li $class>" . html::a($link, $lang->task->import, '', $misc) . '</li>';
?>
<script>
$(function()
{
    $('#exportActionMenu').append(<?php echo json_encode($exportHtml);?>);
    $('#importActionMenu').prepend(<?php echo json_encode($importHtml);?>);
    $(".importExcel").modalTrigger({width:650, type:'iframe'});
    $(".exportTemplet").modalTrigger({width:650, type:'iframe'});
})
</script>
