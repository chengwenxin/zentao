<?php
$version = $config->version;
$version = str_replace('biz', $lang->bizName . ' ', $config->version);
?>
<script>
$(function()
{
    $('#mainContent h4').html(<?php echo json_encode($version);?>);
})
</script>
