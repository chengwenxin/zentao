<style>
.affix {position:fixed; top:0px; width:95.6%;z-index:10000;}
</style>
<script>
function affix(obj)
{
    var fixH = $(obj).offset().top;
    var first = true;
    $(window).scroll(function()
    {
        var scroH = $(this).scrollTop();
        if(scroH>=fixH && first)
        {
            $(obj).parent().parent().before("<table class='table table-form' id='headerClone'></table>");
            $('#headerClone').append($(obj).clone()).addClass('affix');
            $('.table ' + obj + ' th').each(function(i){$('#headerClone ' + obj + ' th').eq(i).width($(this).width())});
            first = false;
        }
        else if(scroH<fixH)
        {
            $("#headerClone").remove();
            first = true;
        }
    });
}
</script>
