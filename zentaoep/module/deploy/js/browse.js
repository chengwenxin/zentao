$(function()
{
    $('.form-month').datetimepicker($.extend(window.datepickerOptions, {startView: 3, format: 'yyyy-mm', minView: 3}))
    var boardID  = '';
    var onlybody = config.requestType == 'GET' ? "&onlybody=yes" : "?onlybody=yes";
    $(".kanbanFrame").modalTrigger({type: 'iframe', width: '80%', afterShow:function(){ $('#ajaxModal').data('cancel-reload', true)}, afterHidden: function(){refresh()}});

    var $kanban = $('#kanban');
    var $kanbanWrapper = $('#kanbanWrapper');

    initBoards();

    var statusMap =
    {
        deploy:
        {
            today     : {done: 'finish'},
            tomorrow  : {done: 'finish'},
            thisweek  : {done: 'finish'},
            thismonth : {done: 'finish'},
            done      : {today: 'activate', tomorrow: 'activate', thisweek: 'activate', thismonth: 'activate'}
        }
    };

    var lastOperation;

    function dropTo(id, from, to, type)
    {
        if(statusMap[type][from] && statusMap[type][from][to])
        {
            lastOperation = {id: id, from: from, to: to};
            new $.zui.ModalTrigger({type: 'iframe', url: createLink(type, statusMap[type][from][to], 'id=' + id) + onlybody, afterShow:function(){ $('#ajaxModal').data('cancel-reload', true)}, afterHidden: function()
            {
                refresh();
            }}).show();
            return true;
        }
        return false;
    }

    function initBoards()
    {
        $('.col-droppable').append('<div class="board-shadow"></div>');

        var $boardDeploy = $kanban.find('.board-deploy');
        $boardDeploy.droppable(
        {
            target: '.col-droppable',
            flex: true,
            before: function(e)
            {
                if(e.element.find('.dropdown.open').length) return false;
            },
            start: function(e)
            {
                e.element.closest('td').addClass('drag-from').closest('tr').addClass('dragging');
                $kanban.addClass('dragging').find('.board-item-shadow').height(e.element.outerHeight());
            },
            drag: function(e)
            {
                if(e.isNew)
                {
                    var $dargShadow = $('.drag-shadow.board-deploy');
                    for(var status in statusMap['deploy'])
                    {
                        $dargShadow.removeClass('board-deploy-' + status);
                    }
                    $dargShadow.addClass('board-deploy-' + e.target.data('id'));
                }
            },
            drop: function(e)
            {
                if(e.isNew && e.element.closest('tr').data('id') == e.target.closest('tr').data('id'))
                {
                    var result = dropTo(e.element.data('id'), e.element.closest('td').data('id'), e.target.data('id'), 'deploy');
                    if(result !== false)
                    {
                        for(var status in statusMap['deploy'])
                        {
                            e.element.removeClass('board-deploy-' + status);
                        }
                        e.element.addClass('board-deploy-' + e.target.data('id')).insertBefore(e.target.find('.board-shadow'));
                    }
                }
            },
            finish: function(e)
            {
                $kanban.removeClass('dragging drop-in');
                $kanbanWrapper.find('tr.dragging').removeClass('dragging').find('.drop-in, .drag-from').removeClass('drop-in drag-from');
            }
        });
    }

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
});
