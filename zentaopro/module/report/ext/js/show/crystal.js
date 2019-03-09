$(function()
{
    $('table.datatable').datatable(
    {
          customizable  : false, 
          sortable      : false,
          scrollPos     : 'out',
          tableClass    : 'tablesorter',
          storage       : false,
          fixCellHeight : false,
          selectable    : false,
          fixedHeader   : true,
          ready:function()
          {
              var rowspan    = 1;
              var compareVal = '';
              var mergeIndex = 0;
              $('.datatable-rows .datatable-rows-span:first table tr').each(function()
              {
                  var leftHeight = $(this).height();
                  var dataIndex = $(this).data('index');

                  var $right = $('.datatable-rows .datatable-rows-span:last table tr[data-index=' + dataIndex + ']');
                  var rightHeight = $right.height();

                  if(leftHeight > rightHeight) $right.height(leftHeight);
                  if(leftHeight < rightHeight) $(this).height(rightHeight);

                  if(dataIndex == 0)
                  {
                      compareVal = $(this).find('td:first').html();
                      mergeIndex = dataIndex;
                  }

                  if(mergeIndex != dataIndex)
                  {
                      if(compareVal == $(this).find('td:first').html())
                      {
                        rowspan += 1;
                        $(this).parent().find('tr').eq(mergeIndex).find('td:first').attr('rowspan', rowspan);
                        $(this).find('td:first').remove();
                      }
                      else
                      {
                          rowspan    = 1;
                          compareVal = $(this).find('td:first').html();
                          mergeIndex = dataIndex;
                      }
                  }
              })
          }
    });
    fixScroll();
    $('.icon-exclamation-sign').hover(function () {
      $('#desc').removeClass('hidden');
    }, function () {
      $('#desc').addClass('hidden');
    });
});

function fixScroll()
{
    var $scrollwrapper = $('div.datatable').first().find('.scroll-wrapper:first');
    if($scrollwrapper.size() == 0)return;

    var $tfoot       = $('div.datatable').first().find('table tfoot:last');
    var scrollOffset = $scrollwrapper.offset().top + $scrollwrapper.find('.scroll-slide').height();
    if($tfoot.size() > 0) scrollOffset += $tfoot.height();
    if($('div.datatable.head-fixed').size() == 0) scrollOffset -= '29';
    var windowH = $(window).height();
    var bottom  = $tfoot.hasClass('fixedTfootAction') ? 53 + $tfoot.height() : 53;
    if(typeof(ssoRedirect) != "undefined") bottom = 53;
    if(scrollOffset > windowH + $(window).scrollTop()) $scrollwrapper.css({'position': 'fixed', 'bottom': bottom + 'px'});
    $(window).scroll(function()
    {
          newBottom = $tfoot.hasClass('fixedTfootAction') ? 53 + $tfoot.height() : 53;
          if(typeof(ssoRedirect) != "undefined") newBottom = 53;
          if(scrollOffset <= windowH + $(window).scrollTop()) 
          {    
            $scrollwrapper.css({'position':'relative', 'bottom': '0px'});
          }    
          else if($scrollwrapper.css('position') != 'fixed' || bottom != newBottom)
          {    
            $scrollwrapper.css({'position': 'fixed', 'bottom': newBottom + 'px'});
            bottom = newBottom;
          }
    });
}
