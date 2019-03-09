<script>
$(function()
{
    <?php if($company):?>
    $('#company').addClass('active');
    <?php else:?>
    $('#department').addClass('active');
    <?php endif;?>
})
</script>
