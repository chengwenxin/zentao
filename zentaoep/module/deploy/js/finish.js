$(function()
{
    $('#result').change(function()
    {
        $('#serviceBox').toggle($(this).val() == 'success');
        $('#hostsBox').toggle($(this).val() == 'success');
    })
});
