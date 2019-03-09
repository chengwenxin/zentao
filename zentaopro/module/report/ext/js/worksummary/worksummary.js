function changeParams(obj)
{
    var begin = $('#conditions').find('#begin').val();
    var end   = $('#conditions').find('#end').val();
    var dept  = $('#conditions').find('#dept').val();
    if(begin.indexOf('-') != -1)
    {
        var beginarray = begin.split("-");
        var begin = '';
        for(i=0 ; i < beginarray.length ; i++)
        {
            begin = begin + beginarray[i]; 
        }
    }
    if(end.indexOf('-') != -1)
    {
        var endarray = end.split("-");
        var end = '';
        for(i=0 ; i < endarray.length ; i++)
        {
            end = end + endarray[i]; 
        }
    }
    link = createLink('report', 'worksummary', 'begin=' + begin + '&end=' + end + '&dept=' + dept);
    location.href=link;
}
