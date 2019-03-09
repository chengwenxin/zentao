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

        var hours = 0;
        var beginTime = Date.parse(new Date(begin + ' ' + start));
        var endTime   = Date.parse(new Date(end + ' ' + finish));
        if(beginTime > endTime) return false;

        if(begin == end)
        {
            hours = Math.round((endTime - beginTime)/(3600*1000)*100)/100;
            if(hours > workingHours) hours = parseFloat(workingHours);
        }
        else
        {
            var signOutTime  = Date.parse(new Date(begin + ' ' + signOut));
            var signInTime   = Date.parse(new Date(end + ' ' + signIn));
            var hoursStart   = 0;
            var hoursEnd     = 0;
            var hoursContent = 0;
            if(beginTime < signOutTime)     hoursStart = Math.round((signOutTime - beginTime)/(3600*1000)*100)/100;
            if(endTime > signInTime)        hoursEnd   = Math.round((endTime - signInTime)/(3600*1000)*100)/100;
            if(workingHours && hoursStart > workingHours) hoursStart = parseFloat(workingHours);
            if(workingHours && hoursEnd   > workingHours) hoursEnd   = parseFloat(workingHours);
            var days = Math.floor((Date.parse(new Date(end)) - Date.parse(new Date(begin)))/(24*3600*1000));
            if(days > 1) hoursContent = (days - 1) * workingHours;

            hours = hoursStart + hoursEnd + hoursContent;
        }
        $('#hours').val(hours);
    });

    $('#begin').change();

    $('input[name=type]').click(function()
    {   
        $('#typeannual').tooltip(
        {
            title: annualTip,
            trigger: 'manual',
            tipClass: 'w-120px tooltip-danger'
        });

        if($('#typeannual').prop('checked'))
        {   
            $('#typeannual').tooltip('show');
        }   
        else
        {   
            $('#typeannual').tooltip('destroy');
        }   
    }); 
})
