$(function()
{
    $('[name^=story]').each(function()
    {
        var width = $(this).parents('td').width();
        $(this).next('.chosen-container').find('.chosen-single').css('min-width', width / 2);
    });
})
