<?php
$version = $config->version;
$version = str_replace('biz', $lang->bizName . ' ', $config->version);

$version = sprintf($lang->admin->info->version, $version);
if($bind) $version .= sprintf($lang->admin->info->account, '<span class="red">' . $account . '</span>');
$version .= $lang->admin->info->links;
?>
<script>
$(function()
{
    $('#mainContent .main-header h2').html(<?php echo json_encode($version);?>);
})
</script>
