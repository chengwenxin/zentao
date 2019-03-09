function changeDate(account,date)
{
    if(date.indexOf('-') != -1)
    {
        var datearray = date.split("-");
        var date = '';
        for(i=0 ; i<datearray.length ; i++)
        {
            date = date + datearray[i]; 
        }
    }
    link = createLink('user', 'effort', 'account=' + account +'&type=' + date);
    location.href=link;
}

$(function()
{
    $('#mainMenu .todoTab').addClass('btn-active-text');
})
