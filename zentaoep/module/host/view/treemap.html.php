<?php
/**
 * The manage view file of host module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     host
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/ext/view/treemap.html.php';?>
<style>#hostsTreemap{overflow:auto;}</style>
<?php js::set('browseType', $type);?>
<div id='mainMenu' class='clearfix'>
  <div class='pull-left btn-toolbar'>
    <?php echo html::a(inlink('browse'), "<span class='text'>{$lang->host->all}</span>", '', "class='btn btn-link' id='allTab'")?>
    <?php echo html::a(inlink('treemap', "type=serverroom"), "<span class='text'>" . $lang->host->treemapList['serverroom'] . '</span>', '', "class='btn btn-link' id='serverroomTab'")?>
    <?php echo html::a(inlink('treemap', "type=group"), "<span class='text'>" . $lang->host->treemapList['group'] . '</span>', '', "class='btn btn-link' id='groupTab'")?>
    <a href='#' class='btn btn-link querybox-toggle' id='bysearchTab'><i class='icon-search icon'></i> <?php echo $lang->host->byQuery;?></a>
  </div>
</div>
<div id='queryBox' class='cell'></div>
<div id='mainContent' class='main-content'>
  <div id='hostsTreemap'>
    <?php echo $treemap;?>
  </div>
</div>
<script>
$(function()
{
    $('#<?php echo $type?>Tab').addClass('btn-active-text');

    /* Init treemap. */
    $('#hostsTreemap').treemap(
    {
        /* Set icon for node. */
        nodeTemplate: function(node, tree)
        {
            var $node = $('<div class="treemap-node"></div>');
            if(node.type) $node.addClass('treemap-node-' + node.type);
            if(node.hostid) $node.attr('data-hostid', node.hostid);
            $node.append('<a class="treemap-node-wrapper">' + node.text + '</a>');
            return $node;
        },
        onNodeClick: function(node)
        {
            if(!node.children)
            {
                var hostID = node.hostid;
                var url = createLink('host', 'view', "hostID=" + hostID, 'html', true);
                $.modalTrigger({width:1000, type:'iframe', url:url});
            }
        }
    });

    var maxHeight = $(window).height() - $('#header').height() - $('#footer').height() - $('#mainMenu').height() - 110;
    $('#hostsTreemap').height(maxHeight);
});
</script>
<?php include '../../common/view/footer.html.php';?>
