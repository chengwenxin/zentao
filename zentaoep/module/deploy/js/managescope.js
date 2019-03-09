function addItem(obj)
{
    $row = $(obj).closest('tr');
    $row.after($row.clone());

    $next = $row.next();
    var oldIndex = $next.find('[id^="service"]').attr('id').replace('service', '');

    $next.find('#service' + oldIndex + '_chosen').remove();
    $next.find('#service' + oldIndex).attr('id', 'service' + index).attr('name', 'service[' + index + ']').val('').chosen();
    $next.find('#hosts' + oldIndex + '_chosen').remove();
    $next.find('#hosts' + oldIndex).attr('id', 'hosts' + index).attr('name', 'hosts[' + index + '][]').val('').chosen();
    $next.find('#offline' + oldIndex+ '_chosen').remove();
    $next.find('#offline' + oldIndex).attr('id', 'offline' + index).attr('name', 'offline[' + index + '][]').val('').chosen();
    $next.find('#online' + oldIndex + '_chosen').remove();
    $next.find('#online' + oldIndex).attr('id', 'online' + index).attr('name', 'online[' + index + '][]').val('').chosen();

    index++;
}

function removeItem(obj)
{
    if($(obj).closest('tbody').find('tr').size() == 1) return false;
    $(obj).closest('tr').remove();
}

function loadHost(obj)
{
    $.get(createLink('host', 'ajaxGetByService', "serviceID=" + $(obj).val()), function(data)
    {
      console.log(data);
        var $tr = $(obj).closest('tr');
        var index = $tr.find('[id^="service"]').attr('id').replace('service', '');
        var hostsVal   = $tr.find('#hosts').val();
        var offlineVal = $tr.find('#offline').val();
        $tr.find('#hosts' + index).closest('td').html(data).find('#hosts').attr('id', 'hosts' + index).attr('name', 'hosts[' + index + '][]');
        $tr.find('#hosts' + index).val(hostsVal);
        $tr.find('#hosts' + index).chosen();

        $tr.find('#offline' + index).closest('td').html(data).find('#hosts').attr('id', 'offline' + index).attr('name', 'offline[' + index + '][]');
        $tr.find('#offline' + index).val(offlineVal);
        $tr.find('#offline' + index).chosen();
    })
}
