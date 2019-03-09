$(document).ready(function()
{
    $('#loginForm').submit(function()
    {
        var password = $('#password').val();
        var rand = $('input#verifyRand').val();
        if(password.length != 32 && typeof(md5) == 'function') $('input:password').val(md5(md5(password) + rand));
    });
});
