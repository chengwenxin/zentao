$(function()
{
    $('#subNavbar ul.nav li').removeClass('active');
    $('#subNavbar ul.nav li[data-id="' + browseType + '"]').addClass('active');
    $('.querybox-toggle').click(function()
    {
        setTimeout(function()
        {
            $('#subNavbar ul.nav li').removeClass('active');
            if($('.querybox-toggle').hasClass('querybox-opened'))
            {
                $('#subNavbar ul.nav li[data-id="bysearch"]').addClass('active');
            }
            else
            {
                $('#subNavbar ul.nav li[data-id="' + browseType + '"]').addClass('active');
            }
        }, 100);
    });
})
