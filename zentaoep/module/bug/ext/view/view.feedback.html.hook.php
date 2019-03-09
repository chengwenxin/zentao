<?php if($bug->feedback):?>
<?php
$link  = html::a($this->createLink('feedback', 'adminview', "feedbackID=$bug->feedback"), " #$bug->feedback $bug->feedbackTitle", '_blank');
$html  = '<tr>';
$html .= '<th>' . $lang->bug->found . '</th>';
$html .= '<td>' . zget($users, $bug->found, $bug->found) . $link . '</td>';
$html .= '</tr>';
?>
<script language='Javascript'>
$(function()
{
    $('#legendBasicInfo').find('table tr:eq(9)').after(<?php echo json_encode($html)?>);
})
</script>
<?php endif;?>
