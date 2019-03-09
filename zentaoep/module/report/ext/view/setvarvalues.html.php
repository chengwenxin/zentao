<?php
/**
 * The setVarValues view file of report module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2014 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     report
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php foreach($sqlVars['varName'] as $i => $varName):?>
<div class='col-md-3 col-sm-6' style='width:220px'>
  <div class='input-group'>
    <?php $sqlVarName = isset($sqlVars['showName'][$i]) ? $sqlVars['showName'][$i] : $varName?>
    <span class='input-group-addon text-ellipsis' style='max-width: 140px' title='<?php echo $sqlVarName;?>'><?php echo $sqlVarName;?></span>
    <?php
    $default = isset($sqlVars['default'][$i]) ? $sqlVars['default'][$i] : '';
    if($sqlVars['requestType'][$i] == 'select') $sqlVars['requestType'][$i] = $sqlVars['selectList'][$i];
    if($sqlVars['requestType'][$i] == 'date')
    {
        echo html::input("sqlVars[$varName]", zget($sqlVarValues, $varName, $default), "class='form-control report-date'");
    }
    elseif($sqlVars['requestType'][$i] == 'product')
    {
        if(!isset($products)) $products = array('' => '') + $this->loadModel('product')->getPairs('nocode');
        echo html::select("sqlVars[$varName]", $products, zget($sqlVarValues, $varName, $default), "class='form-control chosen'");
    }
    elseif($sqlVars['requestType'][$i] == 'project')
    {
        if(!isset($projects)) $projects = array('' => '') + $this->loadModel('project')->getPairs('nocode');
        echo html::select("sqlVars[$varName]", $projects, zget($sqlVarValues, $varName, $default), "class='form-control chosen'");
    }
    elseif($sqlVars['requestType'][$i] == 'dept')
    {
        if(!isset($depts)) $depts = $this->loadModel('dept')->getOptionMenu();
        echo html::select("sqlVars[$varName]", $depts, zget($sqlVarValues, $varName, $default), "class='form-control chosen'");
    }
    elseif($sqlVars['requestType'][$i] == 'user')
    {
        if(!isset($users)) $users = $this->loadModel('user')->getPairs('noletter');
        echo html::select("sqlVars[$varName]", $users, zget($sqlVarValues, $varName, $default), "class='form-control chosen'");
    }
    elseif(strpos($sqlVars['requestType'][$i], '.') !== false)
    {
        list($moduleName, $varListName) = explode('.', $sqlVars['requestType'][$i]);
        $this->app->loadLang($moduleName);
        $varListName .= 'List';
        $varList = $lang->$moduleName->$varListName;
        unset($varList[0]);
        unset($varList['']);
        $varList = array('' => '') + $varList;
        echo html::select("sqlVars[$varName]", $varList, zget($sqlVarValues, $varName, $default), "class='form-control chosen'");
    }
    else
    {
        echo html::input("sqlVars[$varName]", zget($sqlVarValues, $varName, $default), "class='form-control'");
    }
    ?>
  </div>
</div>
<?php endforeach;?>
<script>
var dtOptions = 
{
    language: '<?php echo $this->app->getClientLang();?>',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0,
    format: 'yyyy-mm-dd'
};

$(function()
{
    $('.report-date').each(function()
    {
        time = $(this).val();
        if(!isNaN(time) && time != ''){
            var Y = time.substring(0, 4);
            var m = time.substring(4, 6);
            var d = time.substring(6, 8);
            time = Y + '-' + m + '-' + d;
            $('.report-date').val(time);
        }
    });
    setDateField('.report-date');
});
function setDateField(query)
{
    var $period = $('#selectPeriod');
    if(!$period.length)
    {
        $period = $("<ul id='selectPeriod' class='dropdown-menu'><li><a href='#MONDAY'><?php echo $lang->datepicker->dpText->TEXT_WEEK_MONDAY;?></a></li><li><a href='#SUNDAY'><?php echo $lang->datepicker->dpText->TEXT_WEEK_SUNDAY;?></a></li><li><a href='#MONTHBEGIN'><?php echo $lang->datepicker->dpText->TEXT_MONTH_BEGIN;?></a></li><li><a href='#MONTHEND'><?php echo $lang->datepicker->dpText->TEXT_MONTH_END;?></a></li></ul>").appendTo('body');
        $period.find('li > a').click(function(event)
        {
            var target = $(query).parents('form').find('[id="' + $period.attr('data-target') + '"]');
            if(target.length)
            {
                target.val($(this).attr('href').replace('#', '$'));
                $period.hide();
            }
            event.stopPropagation();
            return false;
        });
    }
    $(query).datetimepicker('remove').datetimepicker(dtOptions).on('show', function(e)
    {
        var $e = $(e.target);
        var ePos = $e.offset();
        $period.css({'left': ePos.left + 210, 'top': ePos.top + 29, 'min-height': $('.datetimepicker').outerHeight()}).show().attr('data-target', $e.attr('id')).find('li.active').removeClass('active');
        $period.find("li > a[href='" + $e.val().replace('$', '#') + "']").closest('li').addClass('active');
    }).on('changeDate', function()
    {
        $period.hide();
    }).on('hide', function(){setTimeout(function(){$period.hide();}, 200);});
}
</script>
