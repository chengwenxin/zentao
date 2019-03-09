<?php if(strpos($config->version, 'biz') === 0):?>
<script>
$(function()
{
    $('#poweredBy a').eq(1).html('<i class="icon-zentao"></i> <?php echo $lang->zentaoPMS . str_replace('biz', $lang->bizName . ' ', $config->version);?>');
})
</script>
<?php endif;?>
<?php if(isset($this->session->bizIoncubeProperties->expireDate) and $this->session->bizIoncubeProperties->expireDate):?>
<?php $expireDate = $this->session->bizIoncubeProperties->expireDate;?>
<?php $limitUsers  = isset($this->session->bizIoncubeProperties->user) ? $this->session->bizIoncubeProperties->user : 0;?>
<script>
<?php
$expireDate = strtolower($expireDate) == 'all life' ? $lang->forever : sprintf($lang->expireDate, $expireDate);
$limitUsers = $limitUsers == 0 ? $lang->unlimited : sprintf($lang->licensedUser, $limitUsers);
?>
$('#poweredBy a').eq(1).attr('title', '<?php echo $expireDate . "，" . $limitUsers; ?>');
</script>
<?php endif;?>
<?php if(isset($this->session->bizIoncubeProperties->userLimited) and $this->session->bizIoncubeProperties->userLimited):?>
<script>
$(function()
{
    $('#poweredBy').after("<?php echo $lang->noticeBizLimited?>");
    $('#bizUserLimited').css('margin-right', '50px');
    if($('#userLimited').size() > 0) $('#userLimited').css('margin-left', 5);
})    
</script>
<?php endif;?>
<?php if(empty($this->app->user->feedback)):?>
<script>
function setFeedbackView(feedbackView)
{
    $.cookie('feedbackView', feedbackView, {expires:config.cookieLife, path:config.webRoot});
    location.href = createLink('index', 'index');
}
$(function()
{
    <?php
    $feedbackView = $this->cookie->feedbackView ? $this->cookie->feedbackView : 0;
    $settingFeedbackView = $feedbackView ? 0 : 1;
    ?>
    $('#mainHeader #heading').append(" <a href='javascript:setFeedbackView(<?php echo $settingFeedbackView?>)' class='btn btn-sm btn-primary'><?php echo $lang->feedbackView[$feedbackView]?></a>");
})
</script>
<?php endif;?>
<?php if(!empty($this->app->user->feedback) or $this->cookie->feedbackView):?>
<script>
$(function()
{
    $('#mainmenu .nav .custom-item').remove();
    $('#topnav .dropdown:last .dropdown-menu li').eq(1).hide();
})
</script>
<?php endif;?>
