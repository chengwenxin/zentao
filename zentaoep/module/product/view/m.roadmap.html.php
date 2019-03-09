<?php
/**
 * The roadmap mobile view file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<div id='roadmapBox' style='overflow-x:auto'>
  <table class='table table-grid active-disabled'>
    <?php 
    unset($roadmaps['total']);
    $years = array_keys($roadmaps);
    foreach($years as $year)
    {
        echo '<tr class="text-center">';
        $yearName = $year == '0000' ? $lang->future : $year . $lang->year;
        echo "<th style='border-right:1px solid #ddd'><h4>$yearName</h4></th>";
        echo '</tr>';
        echo '<tr class="text-center text-top">';
        echo "<td>";
        echo "<table class='table'><tr>";
        foreach($roadmaps[$year] as $branch => $groupRoadmaps)
        {
            echo '<td>';
            if(!empty($branches)) echo "<div class='roadmap branch'>{$branches[$branch]}</div>";
            foreach($groupRoadmaps as $row => $roadmapData)
            {
                foreach($roadmapData as $key => $roadmap)
                {
                    if(isset($roadmap->build))
                    {
                        echo "<div class='roadmap release'>";
                        echo "<h5>" . html::a($this->createLink('release', 'view', "releaseID=$roadmap->id"), $roadmap->name, '_blank') . '</h5>' . $roadmap->date;
                    }
                    else
                    {
                        echo "<div class='roadmap plan'>";
                        echo "<h5>" . html::a($this->createLink('productplan', 'view', "planID=$roadmap->id"), $roadmap->title, '_blank') . '</h5>' . $roadmap->begin . ' ~ ' . $roadmap->end;
                    }
                    echo "</div>";
                    if(isset($roadmapData[$key - 1])) echo "<h5>{$lang->downArrow}</h5>";
                }
            }
            echo '</td>';
        }
        echo '</tr></table>';
        echo '</td>';
        echo '</tr>';
    }
    ?>
  </table>
</div>
<?php include '../../common/view/m.footer.html.php';?>
