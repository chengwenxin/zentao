function setComment(type)
{
    $('#commentBox').toggle();
    $('#commentBox #type').val(type);
    $('#commentBox textarea').val('');
    window.editor['comment'].html('');
    $('.ke-container').css('width', '100%');
}

function like(feedbackID)
{
    var likeLink = createLink('feedback', 'ajaxLike', 'feedbackID=' + feedbackID);
    $('.likesBox').load(likeLink);
}

$(function()
{
    if(window['browseType'] == 'bysearch') $.toggleQueryBox(true);

    $('#allCheckerGrantProduct').click(function()
    {
        var checked = $(this).prop('checked');
        $('#grantProduct').find('input[type=checkbox]').prop('checked', checked);
    })
    $('#allCheckerNoGrantProduct').click(function()
    {
        var checked = $(this).prop('checked');
        $('#noGrantProduct').find('input[type=checkbox]').prop('checked', checked);
    })
})
