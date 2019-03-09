<?php
$version = $config->version;
$version = str_replace('pro', $lang->proName . ' ', $config->version);

$version = sprintf($lang->admin->info->version, $version);
if($bind) $version .= sprintf($lang->admin->info->account, '<span class="red">' . $account . '</span>');
$version .= $lang->admin->info->links;
?>
<?php if(!isset($this->config->bizVersion)):?>
<script>
$(function()
{
    $('#mainContent .main-header h2').html(<?php echo json_encode($version);?>);
})
</script>
<?php endif;?>
