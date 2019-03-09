<script>
$(function()
{
    <?php if($user->feedback):?>
    $('.container .table tr').eq(1).find('td:last').append("<span class='label label-info'><?php echo $lang->user->feedback?></span>");
    <?php endif;?>
});
</script>
