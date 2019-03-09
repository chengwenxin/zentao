function switchAccount(account, method)
{
    if(method == 'dynamic')
    {   
        link = createLink('user', method, 'period=' + period + '&account=' + account);
    }   
    else if(method == 'todo')
    {   
        link = createLink('user', method, 'account=' + account + '&type=' + type);
    }   
    else
    {   
        link = createLink('user', method, 'account=' + account);
    }   
    location.href=link;
}

function fixSubMenu()
{
    var winWidth = $(window).width();
    var width    = 0;
    $('#subMenu a').each(function()
    {
        width += $(this).width();
    });

    if(width > winWidth)
    {
        $('#subMenu a.moreSubMenu').removeClass('hidden');
        var lastNav = $('#subMenu > a').not('.moreSubMenu').last();
        lastNav.addClass('item').css('display', lastNav.css('display'));
        $('#moreSubMenu').prepend("<div class='divider no-margin'></div>");
        $('#moreSubMenu').prepend(lastNav);

        fixSubMenu();
    }
}

$(function(){fixSubMenu();});
