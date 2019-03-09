function loadProductProjects(productID)
{
    link = createLink('product', 'ajaxGetProjects', 'productID=' + productID + '&projectID=' + $('#projectIdBox #project').val());

    $('#projectIdBox .chosen-container').remove();
    $('#projectIdBox select').remove();
    $.get(link, function(data)
    {
        $('#projectIdBox').append(data).find('select').chosen();
    });
}
function loadDeptUsers(deptID)
{
    link = createLink('dept', 'ajaxGetUsers', 'dept=' + deptID + '&user=' + $('#userBox #user').val());

    $('#userBox .chosen-container').remove();
    $('#userBox select').remove();
    $.get(link, function(data)
    {
        $('#userBox').append(data).find('select').chosen();
    })
}
function loadProjectRelated(){}

$(function()
{
    var $showdata = $('#showdata');
    $showdata.load($showdata.data('url'), function()
    {
        if($.fn.datatable)
        {
            $showdata.find('table.datatable').datatable({fixedLeftWidth: 200, scrollPos: 'out', customizable: false, sortable: false, mergeRows: true});
        }
    });

    var dateVal = $('#featurebar ul.nav li #date').val();
    $('#date').focus(function(){$(this).val('').datetimepicker('update');}).blur(function(){$(this).val(dateVal)});
    if($('#showAll').prop('checked'))
    {
        $('.side #user').attr('disabled', true);
        $('.side #user').trigger("chosen:updated");
    }
    $('#showAll').change(function()
    {
        if($(this).prop('checked'))
        {
            $('.side #user').attr('disabled', true);
        }
        else
        {
            $('.side #user').removeAttr('disabled');
        }
        $('.side #user').trigger("chosen:updated");
    });
});
