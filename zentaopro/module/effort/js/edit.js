$(function()
{
    $('#left').parents('tr').toggle($('#objectType').val() == 'task');
    $('#objectType').change(function()
    {
        $('#left').parents('tr').toggle($('#objectType').val() == 'task');
    });
})
