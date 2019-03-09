<?php
if(empty($this->app->user->signed) and $this->loadModel('attend')->checkSignIn())
{
    $_SESSION['user']->signed = true;
    $this->app->user->signed  = true;

    $_SESSION['user']->mustSignOut = $this->config->attend->mustSignOut;
    $this->app->user->mustSignOut  = $this->config->attend->mustSignOut;
}
?>
<?php if(empty($this->app->user->signed)) $this->loadModel('attend')->signIn($this->app->user->account);?>
<script>
<?php $moduleName = $this->app->getModuleName();?>
<?php if(isset($lang->oa->menu->$moduleName)):?>
$('#footer #crumbs').append("<i class='icon-angle-right'></i> <?php echo $title?>");
<?php endif;?>
$.extend(
{
    /**
     * Set ajax loader.
     * 
     * Bind click event for some elements thus when click them, 
     * use $.load to load page into target.
     *
     * @param string selector
     * @param string target
     */
    setAjaxLoader: function(selector, target)
    {
        /* Avoid duplication of binding */
        var data = $('body').data('ajaxLoader');
        if(data && data[selector]) return;
        if(!data) data = {};
        data[selector] = true;
        $('body').data('ajaxLoader', data);

        $(document).on('click', selector, function()
        {
            var url = $(this).attr('href');
            if(!url) url = $(this).data('rel');
            if(!url) return false;

            var $target = $(target);
            if(!$target.size()) return false;

            var width = $(this).data('width');
            $target.load(url, function()
            {
                if(width) $target.find('.modal-dialog').css('width', width); 
                if($target.hasClass('modal') && $.zui.ajustModalPosition) $.zui.ajustModalPosition();
            });

            return false;
        });
    },

    /**
     * Set ajax jsoner.
     *
     * @param string   selector
     * @param object   callback
     */
    setAjaxJSONER: function(selector, callback)
    {
        $(document).on('click', selector, function()
        {
            /* Try to get the href of current element, then try it's data-rel attribute. */
            url = $(this).attr('href');
            if(!url) url = $(this).data('rel');
            if(!url) return false;
            
            $.getJSON(url, function(response)
            {
                /* If set callback, call it. */
                if($.isFunction(callback)) return callback(response);

                /* If the response has message attribute, show it in #responser or alert it. */
                if(response.message)
                {
                    if($('#responser').length)
                    {
                        $('#responser').html(response.message);
                        $('#responser').addClass('text-info f-12px');
                        $('#responser').show().delay(3000).fadeOut(100);
                    }
                    else
                    {
                        bootbox.alert(response.message);
                    }
                }

                /* If the response has locate param, locate the browse. */
                if(response.locate) return location.href = response.locate;

                /* If target and source returned in reponse, update target with the source. */
                if(response.target && response.source)
                {
                    $(response.target).load(response.source);
                }
            });

            return false;
        });
    },

    /**
     * Set ajax deleter.
     * 
     * @param  string $selector 
     * @access public
     * @return void
     */
    setAjaxDeleter: function (selector, callback)
    {
        $(document).on('click', selector, function()
        {
            if(confirm(v.lang.confirmDelete))
            {
                var deleter = $(this);
                deleter.text(v.lang.deleteing);

                $.getJSON(deleter.attr('href'), function(data) 
                {
                    callback && callback(data);
                    if(data.result == 'success')
                    {
                        if(deleter.parents('#ajaxModal').size()) return $.reloadAjaxModal(1200);
                        if(data.locate) return location.href = data.locate;
                        return location.reload();
                    }
                    else
                    {
                        alert(data.message);
                        return location.reload();
                    }
                });
            }
            return false;
        });
    },

    /**
     * Set reload deleter.
     * 
     * @param  string $selector 
     * @access public
     * @return void
     */
    setReloadDeleter: function (selector)
    {
        $(document).on('click', selector, function()
        {
            if(confirm(v.lang.confirmDelete))
            {
                var deleter = $(this);
                deleter.text(v.lang.deleteing);

                $.getJSON(deleter.attr('href'), function(data) 
                {
                    var afterDelete = deleter.data('afterDelete');
                    if($.isFunction(afterDelete))
                    {
                        $.proxy(afterDelete, deleter)(data);
                    }

                    if(data.result == 'success')
                    {
                        var table     = $(deleter).closest('table');
                        var replaceID = table.attr('id');

                        table.wrap("<div id='tmpDiv'></div>");
                        var $tmpDiv = $('#tmpDiv');
                        $tmpDiv.load(document.location.href + ' #' + replaceID, function()
                        {
                            $tmpDiv.replaceWith($tmpDiv.html());
                            var $target = $('#' + replaceID);
                            $target.find('.reloadDeleter').data('afterDelete', afterDelete);
                            $target.find('[data-toggle="modal"]').modalTrigger();
                            if($target.hasClass('table-data'))
                            {
                                $target.dataTable();
                            }
                            if(typeof sortTable == 'function')
                            {   
                                sortTable(); 
                            }   
                            else
                            {   
                                $('tfoot td').css('background', 'white').unbind('click').unbind('hover');
                            }
                        });
                    }
                    else
                    {
                        alert(data.message);
                    }
                });
            }
            return false;
        });
    },

    /**
     * Set reload.
     * 
     * @param  string $selector 
     * @access public
     * @return void
     */
    setReload: function (selector)
    {
        $(document).on('click', selector, function()
        {
            var reload = $(this);
            $.getJSON(reload.attr('href'), function(data) 
            {
                if(data.result == 'success')
                {
                    var table     = $(reload).closest('table');
                    var replaceID = table.attr('id');

                    table.wrap("<div id='tmpDiv'></div>");
                    $('#tmpDiv').load(document.location.href + ' #' + replaceID, function()
                    {   
                        $('#tmpDiv').replaceWith($('#tmpDiv').html());
                        if(typeof sortTable == 'function')
                        {   
                            sortTable(); 
                        }   
                        else
                        {   
                            $('tfoot td').css('background', 'white').unbind('click').unbind('hover');
                        }   
                    });
                }
                else
                {
                    alert(data.message);
                }
            });
            return false;
        });
    },

    /**
     * Reload ajax modal.
     *
     * @param int duration 
     * @access public
     * @return void
     */
    reloadAjaxModal: function(duration)
    {
        if(typeof(duration) == 'undefined') duration = 1000;
        setTimeout(function()
        {
            var modal = $('#ajaxModal');
            modal.load(modal.attr('ref'), function(){$(this).find('.modal-dialog').css('width', $(this).data('width')); $.zui.ajustModalPosition()})
        }, duration);
    }
});

$(function()
{
    $.setAjaxLoader('.loadInModal', '#ajaxModal');
    $('[data-toggle="tooltip"]').tooltip();
})

function setRequiredFields()
{
    if(!config.requiredFields) return false;
    requiredFields = config.requiredFields.split(',');
    for(i = 0; i < requiredFields.length; i++) 
    {    
        $('#' + requiredFields[i]).closest('td,th').prepend("<div class='required required-wrapper'></div>");
        var colEle = $('#' + requiredFields[i]).closest('[class*="col-"]');
        if(colEle.parent().hasClass('form-group')) colEle.addClass('required');
    }    
}
</script>
