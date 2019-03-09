<?php include dirname(__FILE__) . '/browse.zentaobiz.html.hook.php';?>
<?php if(!empty($this->app->user->feedback) or $this->cookie->feedbackView):?>
<script>
$(function()
{
    $('#productBox').remove();
    $('#projectBox').remove();
});
</script>
<?php endif;?>
