function addStepItem(obj)
{
    $row = $(obj).closest('tr');
    $row.after($row.clone());
    $next = $row.next();
    $next.find('#assignedTo_chosen').remove();
    $next.find('#assignedTo').val('ditto').chosen();
    $next.find('#stage').val('ditto');
    $next.find('input[id^="begin"]').val($row.find('input[id^="end"]').val()).datetimepicker($.extend(window.datepickerOptions, {startView:2, format: 'yyyy-mm-dd hh:ii'}));
    $next.find('input[id^="end"]').val('').datetimepicker(window.datepickerOptions);
    $next.find('input[id^="title"]').val('');
    $next.find('[id^="content"]').val('');
    $next.find('[id^="id"]').remove();
    changeIndex(obj);
}

function removeStepItem(obj)
{
    if($(obj).closest('tbody').find('tr').size() == 1) return false;
    $(obj).closest('tr').remove();
}

function changeIndex(obj)
{
    $(obj).closest('tbody').find('tr').each(function(i)
    {
        $(this).find('td:first').html(i + 1);
    });
}
