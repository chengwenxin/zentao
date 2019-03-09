<?php if(strpos($config->version, 'pro') === 0):?>
<script>
$(function()
{
    $('#poweredBy a').eq(1).html('<i class="icon-zentao"></i> <?php echo $lang->zentaoPMS . str_replace('pro', $lang->proName . ' ', $config->version)?>');
})
</script>
<?php endif;?>
<?php if($this->app->user->admin and !isset($this->app->user->extensionChecked)):?>
<?php $this->loadModel('extension')->expireCheck();?>
<?php endif;?>
<?php if(isset($this->session->ioncubeProperties->expireDate) and $this->session->ioncubeProperties->expireDate):?>
<?php $expireDate = $this->session->ioncubeProperties->expireDate;?>
<?php $limitUsers  = isset($this->session->ioncubeProperties->user) ? $this->session->ioncubeProperties->user : 0;?>
<script>
<?php
$expireDate = strtolower($expireDate) == 'all life' ? $lang->forever : sprintf($lang->expireDate, $expireDate);
$limitUsers = $limitUsers == 0 ? $lang->unlimited : sprintf($lang->licensedUser, $limitUsers);
?>
$('#poweredBy a').eq(1).attr('title', '<?php echo $expireDate . "，" . $limitUsers; ?>');
</script>
<?php endif;?>
<?php if(isset($this->session->ioncubeProperties->company) and $this->session->ioncubeProperties->company == 'try'):?>
<script>
$('#poweredBy a').eq(1).after("(<?php echo $config->version . ' ' . $lang->try;?>)");
</script>
<?php endif;?>
<?php if(isset($this->session->ioncubeProperties->userLimited) and $this->session->ioncubeProperties->userLimited):?>
<script>
$(function()
{
    $('#poweredBy').prepend("<?php echo $lang->noticeLimited?>");
    $('#userLimited').css('margin-right', '50px');
})    
</script>
<?php endif;?>
