function changeDate(objectType, objectID, account, date)
{
    date = date.replace(/\-/g, '');
    link = createLink('effort', 'createforobject', 'objectType=' + objectType + '&objectID=' + objectID + '&account=' +account + '&date=' + date);
    location.href=link;
}

$(function()
{
    $('#objectTable .showinonlybody').each(function()
    {
        $(this).click(function()
        {
            var hasRecord = false;
            $('#objectTable').find('input[name^="consumed"], input[name^="left"], input[name^="work"]').each(function()
            {
                if($(this).val() !== '')
                {
                    hasRecord = true;
                    return false;
                }
            });
            if(hasRecord)
            {
                alert(noticeSaveRecord);
                return false;
            }
        });
    });
})
