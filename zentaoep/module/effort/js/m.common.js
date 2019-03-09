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
