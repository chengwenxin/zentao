$(document).ready(function()
{
    var status = ',leave,makeup,overtime,lieu,trip,egress,';
    if(status == 'normal' || (reason && status.indexOf(',' + status + ',') == -1 ))
    {
        $('.editMode').hide();
        $('.viewMode').show();
    }
    else
    {
        $('.editMode').show();
        $('.viewMode').hide();
    }

    $('.edit').click(function()
    {
        $('.editMode').show();
        $('.viewMode').hide();
    })
})
