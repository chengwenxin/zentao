function addField(obj)
{
  var tbody = $(obj).parent().parent().parent().parent();
  var tr    = tbody.find('tr:first');
  tbody.append('<tr></tr>');
  tbody.find('tr:last').append('<td style="overflow: visible">' + tr.find('td').eq(0).html() + '</td>');
  tbody.find('tr:last').append('<td>' + tr.find('td').eq(1).html() + '</td>');
  tbody.find('tr:last').append('<td class="text-center">' + tr.find('td').eq(2).html() + '</td>');
  tbody.find('tr:last').append('<td style="overflow: visible">' + tr.find('td').eq(3).html() + '</td>');
  tbody.find('tr:last').append('<td>' + tr.find('td').eq(4).html() + '</td>');

  tbody.find('tr:last').find('td').eq(0).find('.chosen-container').remove();
  tbody.find('tr:last').find('td').eq(0).find('select').attr('id', 'repordField' + tbody.find('tr:last').index());
  tbody.find('tr:last').find('td').eq(0).find('select').val('');
  tbody.find('tr:last').find('td').eq(0).find('input:checkbox').attr('name', 'isUser[reportField][' + tbody.find('tr:last').index() + '][]');
  tbody.find('tr:last').find('td').eq(2).find('input:checkbox').attr('name', 'reportTotal[' + tbody.find('tr:last').index() + ']');
  tbody.find('tr:last').find('td').eq(3).find('input:checkbox[name^="percent"]').attr('name', 'percent[' + tbody.find('tr:last').index() + ']');
  tbody.find('tr:last').find('td').eq(3).find('input:checkbox[name^="showAlone"]').attr('name', 'showAlone[' + tbody.find('tr:last').index() + ']');
  tbody.find('tr:last').find('td').eq(3).find('select').attr('name', 'contrast[' + tbody.find('tr:last').index() + ']');
  tbody.find('tr:last').find('td').eq(3).find('select').val('');
  tbody.find('tr:last').find('td').eq(1).find('select').val('');
  tbody.find('tr:last').find('td').eq(2).find(':checkbox').removeAttr('checked');
  tbody.find('tr:last').find('td').eq(3).find(':checkbox').removeAttr('checked');

  tbody.find('tr:last').find('td').eq(0).find('select').chosen();
}

function deleteField(obj)
{
  if($(obj).parent().parent().parent().index() == 0) return false;
  $(obj).parent().parent().parent().remove();
}

function toggleContrast(obj)
{
    if($(obj).prop('checked'))
    {
        $(obj).parent().parent().parent().find('.contrastField').removeAttr('disabled');
        $(obj).parent().parent().parent().find('select').val($(obj).parent().parent().parent().parent().find('select#reportField').val());
    }
    else
    {
        $(obj).parent().parent().parent().find('.contrastField').attr('disabled', 'disabled');
    }
}

function toggleSumAppend(obj)
{
    if($(obj).val() == 'sum')
    {
        $(obj).parent().find('select').eq(1).removeClass('hidden');
        $(obj).parent().find('select').eq(1).val($(obj).parents('td').prev().find('select').val());
    }
    else if($(obj).val() == 'count')
    {
        $(obj).parent().find('select').eq(1).addClass('hidden');
    }
}

function toggleSelectList(obj)
{
    if($(obj).val() == 'select')
    {
        $(obj).parents('td').find('select').removeClass('hidden');
    }
    else
    {
        $(obj).parents('td').find('select').addClass('hidden');
    }
}

$(function()
{
    $('.sqlForm button:submit').click(function()
    {
        $.post(createLink('report', 'ajaxCheckVar', 'reportID=' + reportID), {'sql': $('.sqlForm #sql').val()}, function(data)
        {
            if(data)
            {
                data = eval('(' + data + ')');
                var html = $('#setVar table tbody tr:first').html();
                $('#setVar table tbody').empty();
                for(i in data)
                {
                    $('#setVar table tbody').append('<tr>' + html + '</tr>');
                    $('#setVar table tbody tr:last td:first').find('span:first').html(data[i]);
                    $('#setVar table tbody tr:last td:first').find('input:hidden').val(data[i]);

                    var index = $('#setVar table tbody tr:last').index();
                    $('#setVar table tbody tr:last td').eq(2).find('input:radio').attr('name', 'requestType[' + index + ']');
                }
                $('#setVar table #copySql').val($('#sql').val());
                $('#setVar').modal('show');
                return false;
            }
            $('.sqlForm button:submit').removeAttr('id');
            $('.sqlForm').submit();
            return true;
        });
        return false;
    })

    $('.sqlForm .addVar').click(function()
    {
        $('#addVar table #copySql').val($('#sql').val());
        $('#addVar').modal('show');
    })
})
