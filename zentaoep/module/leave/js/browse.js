$(document).ready(function()
{
    $(document).on('click', '#leaveTable td:not(.idTD,.actionTD)', function()
    {
        $.zui.modalTrigger.show({name : 'ajaxModal', url : $(this).parent().data('url'), backdrop : 'static'});
        return false;
    });

    $(document).on('click', '.deleteLeave', function()
    {
        if(confirm(lang.confirmDelete))
        {
            $(this).text(lang.deleting);
            $.getJSON($(this).attr('href'), function(data)
            {
                if(data.result == 'success')
                {
                    if(data.locate) return location.href = data.locate;
                    return location.reload();
                }
                else
                {
                    alert(data.message);
                    if(selecter.parents('#ajaxModal').size()) return $.reloadAjaxModal(1200);
                    return location.reload();
                }
            });
        }
        return false;
    });

    $(document).on('click', '.reviewPass', function()
    {
        if(confirm(confirmReview.pass))
        {
            var selecter = $(this);

            $.getJSON(selecter.attr('href'), function(data) 
            {
                if(data.result == 'success')
                {
                    if(data.locate) return location.href = data.locate;
                    return location.reload();
                }
                else
                {
                    alert(data.message);
                    return location.reload();
                }
            });
        }
        return false;
    });

    $('.batchPass').on('click', function()
    {
        $('#ajaxForm').submit();
    });

    /* expand active tree. */
    $('.tree li.active .hitarea').click();
});
