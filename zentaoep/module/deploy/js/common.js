function addItem(obj)
{
    $row = $(obj).closest('.table-row');
    $row.after($row.clone());
    $next = $row.next();
    $next.find('.productCol #product_chosen').remove();
    $next.find('.productCol select').val('0').chosen();
    $next.find('.releaseCol #release_chosen').remove();
    $next.find('.releaseCol select').val('0').chosen();
}

function removeItem(obj)
{
    if($(obj).closest('td').find('.table-row').size() == 1) return false;
    $(obj).closest('.table-row').remove();
}

function loadRelease(obj)
{
    var $releaseCol = $(obj).closest('.table-row').find('.releaseCol .input-group');
    $releaseCol.find('select').remove();
    $releaseCol.find('.chosen-container').remove();
    $.get(createLink('release', 'ajaxGetByProduct', "product=" + $(obj).val()), function(data)
    {
        $releaseCol.append(data);
        $releaseCol.find('select').attr('name', 'release[]').chosen();
    });
}

function refresh()
{
    var selfClose = $.cookie('selfClose');
    $.cookie('selfClose', 0, {expires:config.cookieLife, path:config.webRoot});
    if(selfClose == 1)
    {
        $('#kanbanWrapper').wrap("<div id='tempDIV'></div>");
        $('#tempDIV').load(location.href + ' #kanbanWrapper', function()
        {
            $('#kanbanWrapper').unwrap();
            initBoards()
            $(".kanbanFrame").modalTrigger({type: 'iframe', width: '80%', afterShow:function(){ $('#ajaxModal').data('cancel-reload', true)}, afterHidden: function(){refresh()}});
        });
    }
}

$(function()
{
    $('[data-id="create"] a').modalTrigger({type: 'ajax', width: '1200'});
});
