$(document).ready(function()
{
    $('#mainNavbar .navbar-nav li').removeClass('active').find('a[href*=' + type + ']').parent().addClass('active');
});
