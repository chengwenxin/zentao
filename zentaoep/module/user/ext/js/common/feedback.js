function setFeedback(obj)
{
    var $obj       = $(obj);
    var developer  = $obj.prop('checked') ? '0' : '1';
    var feedbacker = $obj.prop('checked') ? '1' : '0';
    $(obj).closest('.input-group-addon').find('[name^=feedback]').val(feedbacker);
    $.get(createLink('group', 'ajaxGetPairs', "developer=" + developer), function(data)
    {
        var $group = $obj.closest('tr').find('select[id^=group]');
        var value  = $group.val();
        var chosen = $group.hasClass('chosen');
        var index  = $obj.attr('id').replace('feedback', '');

        if(typeof(defaultGroup) != 'undefined') value = defaultGroup;
        var preIndex = index - 1;
        if(preIndex >= 0)
        {
            var $preFeedback = $('input[id=feedback' + preIndex + ']');
            if($obj.prop('checked') != $preFeedback.prop('checked') && value == 'ditto') value = 0;
        }

        $group.closest('td').html(data);
        $objGroup = $obj.closest('tr').find('#group');
        $objGroup.attr('id', 'group' + index).attr('name', 'group[' + index + ']');
        if(typeof(ditto) != 'undefined') $objGroup.append("<option value='ditto'>" + ditto + "</option>");
        $objGroup.val(value);
        if(chosen) $obj.closest('tr').find('select[id^=group]').addClass('chosen').chosen();
    });
}

function appendFeedback(obj, feedback, feedbackName, feedbackNotice)
{
    if(typeof('feedback') == 'undefined') feedback = '0';
    if(typeof('feedbackName') == 'undefined') feedbackName = '';
    if(typeof('feedbackNotice') == 'undefined') feedbackNotice = '';
    $(obj).wrap("<div class='input-group'></div>");
    $(obj).after("<span class='input-group-addon'><label class='checkbox-inline' for='feedback' title='" + feedbackNotice + "'><input type='hidden' name='feedback' id='realFeedback' value='" + feedback + "' /><input type='checkbox' id='feedback'" + (feedback == '1' ? ' checked ' : '') + "onchange='setFeedback(this)'/> " + feedbackName + "</label></span>");
}
