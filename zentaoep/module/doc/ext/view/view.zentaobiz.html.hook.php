<?php
$diffHtml = '';
if(!$doc->deleted and !empty($versions) and common::hasPriv('doc', 'diff'))
{
    $diffHtml .= "<div class='btn-group versions dropup'>";
    $diffHtml .= "<button data-toggle='dropdown' type='button' class='btn dropdown-toggle'>{$lang->doc->diff} <span class='caret'></span></button>";
    $diffHtml .= "<ul class='dropdown-menu'>";
    foreach($versions as $i => $versionTitle)
    {
        if($i == $version) continue;
        $diffHtml .= '<li>' . html::a(inlink('diff', "docID=$doc->id&newVersion=$version&version=$i"), $versionTitle) . '</li>';
    }
    $diffHtml .= "</ul>";
    $diffHtml .= "</div>";
}
?>
<?php if($diffHtml):?>
<script>
$(function()
{
    $('#mainActions .btn-toolbar .divider').after(<?php echo json_encode($diffHtml)?>);
})
</script>
<?php endif;?>
