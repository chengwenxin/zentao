<?php
$version = $config->version;
$version = str_replace('pro', $lang->proName . ' ', $config->version);
?>
<?php if(!isset($this->config->bizVersion)):?>
<script>
$(function()
{
    $('#mainContent h4').html(<?php echo json_encode($version);?>);
})
</script>
<?php endif;?>
