$(function()
{
    var $showdata = $('#showdata');
    $showdata.load($showdata.data('url') + ' #dataWrapper', function()
    {
        if($.fn.datatable)
        {
            $('#datatable').datatable({fixedLeftWidth: 200, scrollPos: 'out', customizable: false, sortable: false, mergeRows: true});
        }
    });
});
