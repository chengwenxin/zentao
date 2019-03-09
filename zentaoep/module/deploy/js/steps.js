$(function()
{
    var onlybody = config.requestType == 'GET' ? "&onlybody=yes" : "?onlybody=yes";
    $(".kanbanFrame").modalTrigger({type: 'iframe', width: '80%', afterShow:function(){ $('#ajaxModal').data('cancel-reload', true)}, afterHidden: function(){refresh()}});

    var fixH = $("#kanbanHeader").offset().top;
    $(window).scroll(function()
    {
        var scroH = $(this).scrollTop();
        if(scroH>=fixH)
        {
            $("#kanbanHeader").addClass('affix');
            $("#kanbanHeader").width($('#kanbanWrapper').width());
        }
        else if(scroH<fixH)
        {
            $("#kanbanHeader").removeClass('affix');
            $("#kanbanHeader").css('width', '100%');
        }
    });

    $('#kanban').on('click', '.btn-info-toggle', function()
    {
        $btn = $(this);
        $btn.find('i').toggleClass('icon-angle-down').toggleClass('icon-angle-up');
        $btn.parents('.board').toggleClass('show-info');
    });
});
