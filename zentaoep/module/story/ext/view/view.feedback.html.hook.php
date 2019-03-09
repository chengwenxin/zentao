<?php if($story->feedback):?>
<?php
$link = html::a($this->createLink('feedback', 'adminview', "feedbackID=$story->feedback"), " #$story->feedback $story->feedbackTitle", '_blank');
$html = $lang->story->sourceList[$story->source] . ' ' . $story->sourceNote . $link;
?>
<script language='Javascript'>
$(function()
{
    $('#source').html(<?php echo json_encode($html)?>);
})
</script>
<?php endif;?>
