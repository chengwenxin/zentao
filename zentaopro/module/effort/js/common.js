function setLeftInput(obj)
{
    if($(obj).val().indexOf('task_') >= 0)
    {
        $(obj).parent().next().find('input').attr('disabled', false);
        $(obj).parent().next().find('input').removeClass('disabled');
    }
    else
    {
        $(obj).parent().next().find('input').attr('disabled', true);
        $(obj).parent().next().find('input').addClass('disabled');
    }
}

function checkTaskLeft(noticeFinish)
{
    var hasZero = false;
    var length = $("input[name^='left']").size();
    if(length >= 2)
    {
      $("input[name^='left']").each(function()
      {
          if($(this).attr('disabled') != 'disabled' && parseFloat($(this).val(), 10) === 0) hasZero = true;
      })
    }
    else if(length == 1)
    {
        var objectType = $("input[name^='left']").parents('tr').next().find('#objectType').val();
        if(objectType == 'task' && parseFloat($("input[name^='left']").val(), 10) === 0) hasZero = true;
    }
    if(hasZero) return confirm(noticeFinish);
    return true;
}
