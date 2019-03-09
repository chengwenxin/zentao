function updateAction(date)
{
    date = date.replace(/\-/g, '');
    link = createLink('effort', 'batchCreate', 'date=' + date);

    var hasContent = false;
    $('#objectTable tr.effortBox.new input[id^=work]').each(function(){if($(this).val().length > 0) hasContent = true});
    if(!hasContent) return location.href=link;

    cleanEffort();
}

function addEffort(clickedButton)
{
    effortRow = '<tr class="effortBox new">' + $(clickedButton).closest('tr').html() + '</tr>';
    $(clickedButton).closest('tr').after(effortRow);
    var nextBox = $(clickedButton).closest('tr').next('.effortBox');
    $(nextBox).find('input[id^=id]').val(num);
    $(nextBox).find('.chosen-container').remove();
    $(nextBox).find('select').chosen();
    $(nextBox).find('input[id^="left"]').attr('name', "left[" + num + "]").attr('id', "left[" + num + "]");
    setLeftInput($(nextBox).find('select'));

    num++;
    updateID();
}

function deleteEffort(clickedButton)
{
    if($('.effortBox').size() == 1) return;
    $(clickedButton).parent().parent().remove();
    updateID();
}

function cleanEffort()
{
    $('#objectTable tbody tr.computed').remove();
    updateID();
}

function updateID()
{
    i = 1;
    $('.effortID').each(function(){$(this).html(i ++)});
}

$(function()
{
    $('select#objectType').each(function()
    {
        var value = $(this).val(); 
        var $leftInput = $(this).closest('td').next().next().find('input');
        if(value.indexOf('task_') >= 0)
        {
            $leftInput.show();
        }
        else
        {
            $leftInput.hide();
        }
    });

    $(document).on('change', 'select#objectType', function()
    {
        var value     = $(this).val();
        var projectID = projectTask[value] ? projectTask[value] : 0
        var $project  = $(this).closest('tr').find('select#project');
        $project.val(projectID);
        $project.trigger("chosen:updated");

        var $leftInput = $(this).closest('td').next().next().find('input');
        if(value.indexOf('task_') >= 0)
        {
            $leftInput.show();
        }
        else
        {
            $leftInput.hide();
            $project.val(0);
        }
    });
});
