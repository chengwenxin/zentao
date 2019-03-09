function addField(obj)
{
    var tr = $(obj).parents('tr');
    $(obj).parents('tr').after('<tr>' + tr.html() + '</tr>');
}

function deleteField(obj)
{
    if($(obj).parents('tbody').find('tr').size() == 1) return false;
    $(obj).parents('tr').remove();
}
