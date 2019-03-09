/*!
 * jQuery Cookie Plugin v1.3.1
 * https://github.com/carhartl/jquery-cookie
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){function c(a){return h.raw?a:encodeURIComponent(a)}function d(a){return h.raw?a:decodeURIComponent(a)}function e(a){return c(h.json?JSON.stringify(a):String(a))}function f(a){0===a.indexOf('"')&&(a=a.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return a=decodeURIComponent(a.replace(b," ")),h.json?JSON.parse(a):a}catch(c){}}function g(b,c){var d=h.raw?b:f(b);return a.isFunction(c)?c(d):d}var b=/\+/g,h=a.cookie=function(b,f,i){var j,k,l,m,n,o,p,q,r;if(arguments.length>1&&!a.isFunction(f))return i=a.extend({},h.defaults,i),"number"==typeof i.expires&&(j=i.expires,k=i.expires=new Date,k.setMilliseconds(k.getMilliseconds()+864e5*j)),document.cookie=[c(b),"=",e(f),i.expires?"; expires="+i.expires.toUTCString():"",i.path?"; path="+i.path:"",i.domain?"; domain="+i.domain:"",i.secure?"; secure":""].join("");for(l=b?void 0:{},m=document.cookie?document.cookie.split("; "):[],n=0,o=m.length;o>n;n++){if(p=m[n].split("="),q=d(p.shift()),r=p.join("="),b===q){l=g(r,f);break}b||void 0===(r=g(r))||(l[q]=r)}return l};h.defaults={},a.removeCookie=function(b,c){return a.cookie(b,"",a.extend({},c,{expires:-1})),!a.cookie(b)}});

/**
 * Create link.
 *
 * @param  string $moduleName
 * @param  string $methodName
 * @param  string $vars
 * @param  string $viewType
 * @access public
 * @return string
 */
function createLink(moduleName, methodName, vars, viewType, isOnlyBody)
{
    if(!viewType)   viewType   = config.defaultView;
    if(!isOnlyBody) isOnlyBody = false;
    if(vars)
    {
        vars = vars.split('&');
        for(i = 0; i < vars.length; i ++) vars[i] = vars[i].split('=');
    }
    if(config.requestType != 'GET')
    {
        if(config.requestType == 'PATH_INFO')  link = config.webRoot + moduleName + config.requestFix + methodName;
        if(config.requestType == 'PATH_INFO2') link = config.webRoot + 'index.php/'  + moduleName + config.requestFix + methodName;
        if(vars)
        {
            for(i = 0; i < vars.length; i ++) link += config.requestFix + vars[i][1];
        }
        link += '.' + viewType;
    }
    else
    {
        link = config.router + '?' + config.moduleVar + '=' + moduleName + '&' + config.methodVar + '=' + methodName + '&' + config.viewVar + '=' + viewType;
        if(vars) for(i = 0; i < vars.length; i ++) link += '&' + vars[i][0] + '=' + vars[i][1];
    }

    /* if page has onlybody param then add this param in all link. the param hide header and footer. */
    if((typeof(config.onlybody) != 'undefined' && config.onlybody == 'yes') || isOnlyBody)
    {
        var onlybody = config.requestType != 'GET' ? "?onlybody=yes" : '&onlybody=yes';
        link = link + onlybody;
    }
    return link;
}

/**
 * Set language.
 *
 * @access public
 * @return void
 */
function selectLang(lang)
{
    $.cookie('lang', lang, {expires:config.cookieLife, path:config.webRoot});
    location.href = removeAnchor(location.href);
}

/**
 * Set theme.
 *
 * @access public
 * @return void
 */
function selectTheme(theme)
{
    $.cookie('theme', theme, {expires:config.cookieLife, path:config.webRoot});
    location.href = removeAnchor(location.href);
}

/**
 * Remove anchor from the url.
 *
 * @param  string $url
 * @access public
 * @return string
 */
function removeAnchor(url)
{
    pos = url.indexOf('#');
    if(pos > 0) return url.substring(0, pos);
    return url;
}

/**
 * Init sort panel
 *
 * @access public
 * @return void
 */
function initSortPanel()
{
    var $sortTrigger = $('#sortTrigger');
    if(!$sortTrigger.length) return;

    var $list = $('#page > .box > .table tr');
    if(!$list.length) return $sortTrigger.addClass('hidden');

    var $sortPanel = $('#sortPanel');
    if($sortPanel.length)
    {
        var $sortItem = $sortPanel.children('.SortUp, .SortDown').first();
        var sortClass = $sortItem.hasClass('SortUp') ? 'SortUp' : 'SortDown';
        $sortTrigger.removeClass('SortUp SortDown').addClass(sortClass).find('span').text($sortItem.text());
    }
}

/**
 * Fix avatar has text
 */
(function()
{
    var fixAvatar = function()
    {
        var $avatar = $(this);
        if($avatar.hasClass('avatar-no-fix')) return;
        var text = $.trim($avatar.text());
        if(text && text.length > 1)
        {
            $avatar.text(text.substring(0, 1));
        }
    };

    $.fn.fixAvatar = function()
    {
        return this.each(fixAvatar);
    };

    $(document).on('display.displayed', function(e, dp, $e, options)
    {
        if(options && options.$target) options.$target.find('.avatar').fixAvatar();
    });

    $(function() {$('.avatar').fixAvatar();})
})();

/**
 * Refresh content with ajax
 *
 * @param  string selector
 * @param  string url
 * @access public
 * @return void
 */
$.refresh = function(selector, url)
{
    if(selector === true) selector = 'body';
    var $target = $(selector || 'body');
    var $tmp = $('<div/>');
    if(!url)
    {
        url = $target.data('refreshUrl') || $target.parent().data('refreshUrl') || window.location.href;
    }
    else if(url.indexOf(' ') < 1) url += ' body';
    $tmp.load(url, function()
    {
        var $tmpTarget = $tmp.find(selector);
        $target = $target.replaceWith($tmpTarget);
        $tmpTarget.find('[data-skin]').skin();
        $tmpTarget.find('[data-display]').display();
        $tmpTarget.find('.avatar').fixAvatar();
        $tmpTarget.find('.nav-auto').navAuto();
    });
};

/**
 * Init list with actions
 *
 * @access public
 * @return void
 */
$.Display.plugs(
{
    _listAction: function(options)
    {
        return $.extend(options,
        {
            targetDismiss: true,
            selector: options.selector || '.item',
            trigger: 'longTap'
        });
    },
    listAction: function(options)
    {
        return $.extend(options,
        {
            backdrop: true,
            remote: false,
            load: false,
            target: options.actionsPanel || '#actionsPanel',
            show: function(thisOptions)
            {
                var $target  = thisOptions.$target,
                    $element = $(thisOptions.element),
                    actions  = $element.data('actions');
                $target.css('pointerEvents', 'none').children('.item').each(function()
                {
                    var $item = $(this),
                        action = actions[$item.data('action')];
                    if(action)
                    {
                        $item.removeClass('disabled').attr(
                        {
                            disabled: null,
                            'data-href': action
                        }).data('remote', action);
                        if($item.data('refresh'))
                        {
                            $item.data({refresh: '[data-id="' + $element.data('id') + '"]'});
                        }
                        if($item.data('ajaxDelete'))
                        {
                            $item.data({ajaxDelete: '[data-id="' + $element.data('id') + '"]'});
                        }
                    } else $item.addClass('disabled').attr('disabled', 'disabled');
                });
                $target.children('.selected').replaceWith($element.clone().attr('data-id', '').addClass('selected'));
                setTimeout(function(){$target.css('pointerEvents', 'auto');}, 1000);
            }
        });
    },
    ajaxAction: function(options)
    {
        var $element = $(options.element);
        var options = $.Display.plugs.messager.call(this, options);
        var oldTemplate = options.template;
        var isAjaxDelete = options.ajaxDelete;
        return $.extend(options,
        {
            confirm: options.confirm !== undefined ? options.confirm : (options.ajaxDelete ? lang.confirmDelete : false),
            remoteType: 'json',
            show: function(thisOptions)
            {
                return !thisOptions.confirm || confirm(thisOptions.confirm);
            },
            template: function(response, thisOptions)
            {
                var data = $.extend(thisOptions, response);
                var isSuccess = data.result === 'success';
                if(isSuccess)
                {
                    if(data.refresh) $.refresh(data.refresh, data.refreshUrl);
                    if(data.ajaxDelete) $(data.ajaxDelete).remove();
                    if($.isFunction(data.success)) data.success(response);
                }

                var locate = data.locate;
                if(data.resetLocate !== undefined) locate =  data.resetLocate;
                if(locate)
                {
                    setTimeout(function()
                    {
                        if(locate === 'self')
                        {
                            window.location.reload();
                        }
                        else if(data.locateDisplay == 'modal')
                        {
                            var myDisplay = new $.Display({ display: 'modal' });
                            myDisplay.show({ remote: locate, placement: 'bottom'});
                        }
                        else
                        {
                            window.location.href = locate;
                        }
                    }, 1500);
                }

                return data.message ? oldTemplate(data.message, $.extend(data, {type: isSuccess ? 'success' : 'danger', icon: isSuccess ? 'ok-sign' : 'exclamation-sign'})) : false;
            },
            remoteError: function()
            {
                return {result: 'fail', message: lang.timeout || 'Network error.'};
            }
        });
    }
});

/**
 * Disable context menu
 *
 * @param  object $context
 * @access public
 * @return void
 */
function disableContextMenu($context)
{
    ($context || $('.no-contextmenu')).on('contextmenu', function(e) {e.preventDefault(); e.returnValue = false; return false});
}

/**
 * Init list with pager
 *
 * @param  object $list
 * @access public
 * @return void
 */
function initListWithPager($list)
{
    ($list || $('.list-with-pager')).on($.TapName, '.pager-more', function()
    {
        var $pager = $(this);
        if($pager.hasClass('loading')) return;
        $pager.addClass('loading loading-light');

        var $tmp = $('<div/>');
        $tmp.load($pager.data('more') + ' .list-with-pager', function(data) {
            var $tmpList = $tmp.find('.list');
            $tmpList.children('.item').each(function()
            {
                var $tmpItem = $(this);
                var $item = $('[data-id="' + $tmpItem.data('id') + '"]');
                if($item.length)
                {
                    $item.replaceWith($tmpItem.clone());
                    $tmpItem.remove();
                }
            });
            $pager.parent().before($tmp.find('.list'));
            $pager.replaceWith($tmp.find('.pager-more'));
        });
    });
}

/**
 * Reverse toggle
 */
(function()
{
    // http://lab.arc90.com/2008/05/22/jquery-reverse-order-plugin/#licensing
    $.fn.reverseOrder = function(){return this.each(function(){$(this).prependTo( $(this).parent() );});};

    $(function()
    {
        $(document).on($.TapName, '[data-toggle="reverse"]', function()
        {
            var $this = $(this);
            $($this.data('target')).reverseOrder();
            $this.find('.icon-sort-by-order, .icon-sort-by-order-alt').toggleClass('icon-sort-by-order').toggleClass('icon-sort-by-order-alt');
        });
    });
})();

/**
 * Ajax form
 */
(function()
{
    $.fn.modalForm = function(options)
    {
        return $(this).each(function()
        {
            var $form = $(this);
            var thisOptions = $.extend($form.data(), options);
            if(!thisOptions.onResult && !thisOptions.onSuccess && !thisOptions.onComplete)
            {
                thisOptions.onSuccess = function(response)
                {
                    if(response.result === 'success')
                    {
                        $.Display.dismiss();
                        response.locate = false;
                        if(thisOptions.formRefresh) $.refresh(thisOptions.formRefresh);
                        if(thisOptions.displayFrom) $.Display.all[thisOptions.displayFrom].show();
                        $form.find('[data-default-val]').each(function()
                        {
                            var $control = $(this);
                            $control.val($control.data('defaultVal'));
                        });
                    }
                };
            }
            $.ajaxForm($form, thisOptions);
        });
    }

    $(function() {$('.modal-form').modalForm();});

    $(document).on('display.displayed', function(e, dp, $e, options)
    {
        if(options && options.$target) options.$target.find('.modal-form').modalForm();
    });
})();

/**
 * Nav auto justified
 */
(function()
{
    var winWidth = $(window).width();
    $.fn.navAuto = function(options)
    {
        return $(this).each(function()
        {
            var $nav = $(this), width = 0;
            $nav.children('a').each(function(){width += $(this).width();});
            $nav.toggleClass('justified', width < winWidth);
        });
    };

    $(function(){$('.nav-auto').navAuto();});
})();

/**
 * Initialization
 */
$(function()
{
    /**
     * Submit button
     */
    $(document).on($.TapName, '[data-submit]', function()
    {
        $($(this).data('submit')).submit();
    });

    /**
     * Auto intent headline
     */
    var winWidth = $(window).width();
    $('.headline.indent-auto').each(function()
    {
        var $this = $(this);
        $this.toggleClass('indent', ($.trim($this.text()).length * 20 + 100) < winWidth);
    });

    /*
     * Set accent color for mobile app
     */
    if(window.webkit && window.webkit.messageHandlers.App)
    {
        window.App = {};
        window.App.setAccentColor = function(color)
        {
            window.webkit.messageHandlers.App.postMessage({method: 'setAccentColor', color: color});

        }
    }

    $(document).on($.TapName, '.table tr', function(e)
    {
        if($(e.target).closest('a').length) return;
        if($(this).data('url')) window.location = $(this).data('url');
    })
});

$(function()
{
    if(typeof wx === 'undefined') return;

    wx.config(
    {
        debug: false,
        appId: v.appId,    //此处的appId等同于企业的CorpID
        timestamp: iitimestamp,
        nonceStr:  v.nonceStr,
        signature: v.signature,
        jsApiList: ['checkJsApi', 'chooseImage', 'scanQRCode']
    });

    wx.ready(function()
    {
        $(document).on($.TapName, '.scanQRCode', function()
        {
            wx.scanQRCode(
            {
                desc: 'scanQRCode desc',
                needResult: 0,
                scanType: ['qrCode', 'barCode'],
                success: function(response)
                {
                    alert(response.errMsg);
                },
                error: function(response)
                {
                    if(response.errMsg.indexOf('function_not_exist') > 0){alert('版本过低请升级');}
                }
            });
        })

        $(document).on($.TapName, '.chooseImage', function()
        {
            wx.chooseImage(
            {
                count: 1,
                sizeType: ['original', 'compressed'],
                sourceType: ['album', 'camera'],
                success: function (response)
                {
                   wx.uploadImage(
                   {
                       localId: response.localIds[0],
                       isShowProcess: 1,
                       success: function(res)
                       {
                           var imageID = window.btoa(res.serverId);
                           var url = $('.chooseImage').data('url').replace('imageID', imageID);

                           $.getJSON(url, function(data)
                           {
                               alert(data.message)
                           })
                       }
                   })
                }
            });
        })
    })
})

function fixAppnav()
{
    var winWidth = $(window).width();
    var width    = 0;
    $('#appnav a').each(function()
    {
        width += $(this).outerWidth();
    });

    if(width > winWidth)
    {
        $('#appnav a.moreAppnav').removeClass('hidden');
        var lastNav = $('#appnav > a').not('.moreAppnav').last();
        lastNav.addClass('item').css('display', lastNav.css('display'));
        $('#moreAppnav').prepend("<div class='divider no-margin'></div>");
        $('#moreAppnav').prepend(lastNav);

        fixAppnav();
    }
}

function fixMenu()
{
    var winWidth = $(window).width();
    var width    = 0;
    $('#menu a').each(function()
    {
        width += $(this).outerWidth();
    });

    if($('#menu select').length > 0)
    {
        width += $('#menu select').outerWidth();
    }

    if($('#menu #dateBox').length > 0)
    {
        width += $('#menu #dateBox').outerWidth();
    }

    if(width > winWidth)
    {
        $('#menu a.moreMenu').removeClass('hidden');
        var $lastMenu = $('#menu > a').not('.moreMenu').last();
        $lastMenu.addClass('item').css('display', $lastMenu.css('display'));
        $('#moreMenu').prepend("<div class='divider no-margin'></div>").prepend($lastMenu);

        fixMenu();
    }
}

/**
 * Set mailto
 *
 * @param  string mailto
 * @param  int    $contactListID
 * @access public
 * @return void
 */
function setMailto(mailto, contactListID)
{
    link = createLink('user', 'ajaxGetContactUsers', 'listID=' + contactListID);
    $.get(link, function(users)
    {
        $('#' + mailto).replaceWith(users);
    });
}

/**
 * Show search drop menu.
 *
 * @param  string $objectType product|project
 * @param  int    $objectID
 * @param  string $module
 * @param  string $method
 * @param  string $extra
 * @access public
 * @return void
 */
function showSearchMenu(objectType, objectID, module, method, extra)
{
    var main  = objectType == 'branch' ? 'currentBranch' : 'currentItem';
    var $menu = $('#' + main + 'DropMenu');

    var searchItems = function($menu, $items, $search)
    {
        var searchText = $.trim($search.val());
        $menu.removeClass('searching');
        $items.removeClass('active');
        if(searchText !== null && searchText.length)
        {
            $items.removeClass('show-search');
            $menu.addClass('searching');
            var isTag = searchText.length > 1 && (searchText[0] === ':' || searchText[0] === '@' || searchText[0] === '#');
            $items.each(function()
            {
                var $item = $(this);
                var item = $item.data();
                item.key = (item.key || '') + $item.text();
                item.tag = (item.tag || '') + '#' + item.id;
                if((isTag && item.tag.indexOf(searchText) > -1) || item.key.indexOf(searchText) > -1)
                {
                    $item.addClass('show-search');
                }
            });
            var $resultItems = $items.filter('.show-search');
            if(!$resultItems.filter('.active').length)
            {
                $resultItems.first().addClass('active');
            }
        }
    };

    if(!$menu.data('initData'))
    {
        var remoteUrl = createLink(objectType, 'ajaxGetDropMenu', "objectID=" + objectID + "&module=" + module + "&method=" + method + "&extra=" + extra);
        $.get(remoteUrl, function(data)
        {
            $menu.html(data);

            dropMenuDisplay = new $.Display({display: 'modal', source: $menu.html(), placement: 'top'});
            dropMenuDisplay.show(function()
            {
                var $menu   = $('.display.modal.in');
                var $search = $menu.find('#search');
                var $items  = $menu.find('#searchResult .list > .item');
                var searchCallTask = null;
                $search.on('change keyup paste input propertychange', function()
                {
                    clearTimeout(searchCallTask);
                    searchCallTask = setTimeout(searchItems($menu, $items, $search), 100);
                }).focus();
            });
        });
        $menu.data('initData', true);
    }
    else
    {
        dropMenuDisplay = new $.Display({display: 'modal', source: $menu.html(), placement: 'top'});
        dropMenuDisplay.show(function()
        {
            var $menu   = $('.display.modal.in');
            var $search = $menu.find('#search');
            var $items  = $menu.find('#searchResult .list > .item');
            var searchCallTask = null;
            $search.on('change keyup paste input propertychange', function()
            {
                clearTimeout(searchCallTask);
                searchCallTask = setTimeout(searchItems($menu, $items, $search), 100);
            }).focus();
        });
    }
    $('#' + main).on('click', function(e){e.stopPropagation();});
}

/**
 * Set the max with of image.
 *
 * @access public
 * @return void
 */
function setImageSize(image, maxWidth)
{
    /* If not set maxWidth, set it auto. */
    if(!maxWidth)
    {
        bodyWidth = $('body').width();
        maxWidth  = bodyWidth - 470; // The side bar's width is 336, and add some margins.
    }

    if($(image).width() > maxWidth) $(image).attr('width', maxWidth);
    $(image).wrap('<a href="' + $(image).attr('src') + '" target="_blank"></a>');
}

/**
 * Adjust header title width.
 *
 * @access public
 * @return void
 */
function adjustHeaderTitleWidth()
{
    var titleMaxWidth = $('#appbar').width() - 44 * 2 - 30;
    if($('#appbar #headerTitle').width() > titleMaxWidth)
    {
        $('#appbar #headerTitle').width(titleMaxWidth).css({'overflow': 'hidden', "text-overflow": 'ellipsis'});
    }
}

function showSearchObjectID()
{
    var reg = /[^0-9]/;
    var $searchBox = $('#searchBox');
    var $dropmenu = $searchBox.children('.dropdown-search-menu');
    var $searchQuery = $searchBox.find('#words');
		var searchType = $('#searchType').val();

    var refreshMenu = function()
    {
        var val = $searchQuery.val();
				$dropmenu.addClass('hidden')
        if(val !== null && val !== "")
        {
            var isQuickGo = !reg.test(val);
            $dropmenu.toggleClass('show-quick-go', isQuickGo);
            if(isQuickGo)
            {
                $dropmenu.removeClass('with-active').find('li > a').each(function()
                {
                    var $this = $(this);
                    var isActiveType = $this.data('value') === searchType && searchType !== 'all';
                    $this.closest('li').toggleClass('active', isActiveType);
                    $this.html($this.data('name') + ' <span>#' + (val.length > 4 ? (val.substr(0, 4) + '...') : val) + "</span>");
                    if(isActiveType) $dropmenu.addClass('with-active');
                });
								$dropmenu.removeClass('hidden')
            }
        }
    };

    $dropmenu.on('click', 'a', function(e)
    {
        self.location.href= createLink($(this).data('value'), 'view', 'id=' + $searchQuery.val());
        e.stopPropagation();
    }).find('li > a').each(function()
    {
        var $this = $(this);
        $this.attr('data-name', $this.text());
    });
    $searchQuery.on('change keyup paste input propertychange', refreshMenu).on('focus', function()
    {
        setTimeout(refreshMenu, 300);
    });
}

function computePasswordStrength(password)
{
    if(password.length == 0) return 0;

    var strength = 0;
    var length   = password.length;

    var uniqueChars = '';
    var complexity  = new Array();
    for(i = 0; i < length; i++)
    {
        letter = password.charAt(i);
        var asc = letter.charCodeAt();
        if(asc >= 48 && asc <= 57)
        {
            complexity[2] = 2;
        }
        else if((asc >= 65 && asc <= 90))
        {
            complexity[1] = 2;
        }
        else if(asc >= 97 && asc <= 122)
        {
            complexity[0] = 1;
        }
        else
        {
            complexity[3] = 3;
        }
        if(uniqueChars.indexOf(letter) == -1) uniqueChars += letter;
    }

    if(uniqueChars.length > 4) strength += uniqueChars.length - 4;
    var sumComplexity = 0;
    var complexitySize = 0;
    for(i in complexity)
    {
        complexitySize += 1;
        sumComplexity += complexity[i];
    }
    strength += sumComplexity + (2 * (complexitySize - 1));
    if(length < 6 && strength >= 10) strength = 9;

    strength = strength > 29 ? 29 : strength;
    strength = Math.floor(strength / 10);

    return strength;
}

function setPing()
{
    $('#hiddenwin').attr('src', createLink('misc', 'ping'));
}

needPing = true;

$(function()
{
    $(document).on($.TapName, '.lang-menu > a', function()
    {
        selectLang($(this).data('value'));
    });

    if(needPing) setTimeout('setPing()', 1000 * 60 * 10);  // After 10 minutes, begin ping.
	showSearchObjectID()
    adjustHeaderTitleWidth();
    initSortPanel();
    disableContextMenu();
    initListWithPager();
    fixAppnav();
    fixMenu();
});
