$(document).ready(function()
{
    $('#begin, #start, #end, #finish').change(function()
    {
        var begin  = $('#begin').val();
        var end    = $('#end').val();
        var start  = $('#start').val();
        var finish = $('#finish').val();
        if(!begin || !end || !start || !finish) return false;

        begin = begin.replace(/-/g, '/');
        end   = end.replace(/-/g, '/');

        var beginTime = Date.parse(new Date(begin + ' ' + start));
        var endTime   = Date.parse(new Date(end + ' ' + finish));
        if(beginTime > endTime) return false;

        var hours = Math.round((endTime - beginTime)/(3600*1000)*100)/100;
        $('#hours').val(hours);
    });

    $('#begin').change();
})
