<?php
/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     project 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/ext/view/gantt.html.php';?>
<style>
#GanttChartDIV {width:100%;}
#theTable {border:0px;}
#GanttChartDIV table {margin-bottom:0}
#GanttChartDIV th, td {padding:0}
#leftside table tr td {height:20px;overflow:hidden;}
#rightside {border: 1px solid #ddd}
@-moz-document url-prefix()
{
  #leftside table tr td {height:21px;}
}
</style>
<?php include "featurebar.html.php";?>
<div id="mainContent" class="main-row hide-side">
  <div class='main-col'>
    <div class='cell'>
      <div style="position:relative" class="gantt" id="GanttChartDIV"></div>
      <div class='text-right'>
        <?php echo $lang->task->pri . " : "?>
        <?php foreach($lang->project->gantt->color as $pri => $color):?>
        P<?php echo $pri;?><span style="background-color:#<?php echo $color?>; padding:2px 15px;">&nbsp;</span>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</div>
<script language="javascript">
var res       ="<?php echo $lang->project->gantt->assignTo?>";
var duration  ="<?php echo $lang->project->gantt->duration?>";
var comp      ="<?php echo $lang->project->gantt->comp?>";
var startDate ="<?php echo $lang->project->gantt->startDate?>";
var endDate   ="<?php echo $lang->project->gantt->endDate?>";
var days      ="<?php echo $lang->project->gantt->days?>";
var format    ="<?php echo $lang->project->gantt->format?>";
var day       ="<?php echo $lang->project->gantt->day?>";
var week      ="<?php echo $lang->project->gantt->week?>";
var month     ="<?php echo $lang->project->gantt->month?>";
var quarter   ="<?php echo $lang->project->gantt->quarter?>";
var viewType  ="<?php echo trim(str_replace("\n", '', html::select('viewType', $lang->project->gantt->browseType, $ganttType, "onchange='selectType(this)'")))?>";

var g = new JSGantt.GanttChart('g',document.getElementById('GanttChartDIV'), 'day');
g.setShowRes(1);
g.setShowDur(1);
g.setShowComp(1);
g.setCaptionType('Resource');
g.setShowStartDate(1);
g.setShowEndDate(1);
<?php
if($this->cookie->lang == 'en')
{
    echo "g.setDateDisplayFormat('mm/dd/yyyy');\n";
}
else
{
    echo "g.setDateDisplayFormat('yyyy-mm-dd');\n";
}
?>
g.setFormatArr("day","week","month","quarter");
<?php echo $projectData;?>
g.Draw(); 
g.DrawDependencies();
function selectType(obj){location.href = createLink('project', 'gantt', 'projectID=<?php echo $projectID?>&type=' + $(obj).val());}

$('#ganttTab').addClass('active');

$(function()
{
    $('#leftside table tr:first').height('33');
});
</script>
<?php include '../../../common/view/footer.html.php';?>
