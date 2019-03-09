<?php
$linkHtml = '';
if(common::hasPriv('story', 'import')) $linkHtml = html::a($this->createLink('story', 'import', "productID=$productID&branch=$branch"), '<i class="icon-import muted"></i> <span class="text">' . $lang->story->import . '</span>', '', "class='btn btn-link import'");

$class = common::hasPriv('story', 'exportTemplet') ? '' : "class='disabled'";
$link  = common::hasPriv('story', 'exportTemplet') ? $this->createLink('story', 'exportTemplet', "productID=$productID&branch=$branch") : '#';
$misc  = common::hasPriv('story', 'exportTemplet') ? "class='exportTemplet'" : "class='disabled'";
$exportHtml = "<li $class>" . html::a($link, $lang->story->exportTemplet, '', $misc) . '</li>';
?>
<script>
$(function()
{
    $('#mainMenu .pull-right .btn-group').after(<?php echo json_encode($linkHtml)?>);
    $('#exportActionMenu').append(<?php echo json_encode($exportHtml)?>);
    $('.import').modalTrigger({width:650, type:'iframe'})
    $(".exportTemplet").modalTrigger({width:650, type:'iframe'});
})
</script>
