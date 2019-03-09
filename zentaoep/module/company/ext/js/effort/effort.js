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
    if($('#effortList thead th.w-work').width() < 150) $('#effortList thead th.w-work').width(150);
});
