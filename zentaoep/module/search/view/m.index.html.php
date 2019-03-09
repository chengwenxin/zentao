<?php
/**
 * The index mobile view file of search module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     search
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$lang->search->menu = array();
?>
<?php include '../../common/view/m.header.html.php';?>
<style>
#searchForm .title{padding:10px 20px 0px 20px;}
#searchForm #submit{border:1px solid #999;}
.list.with-divider.with-avatar>.item:before{left:0;}
</style>
<form method='post' action='<?php echo inlink('index')?>' id='searchForm'>
  <div class='heading gray'>
    <div class='title'>
      <div class='control-group'>
        <?php echo html::input('words', $words, "class='input'")?>
        <?php echo html::submitButton($lang->search->common)?>
      </div>
    </div>
  </div>
</form>
<div id='page' class='list-with-actions'>
  <div class='list with-divider with-avatar'>
    <?php foreach($results as $object):?>
    <?php $objectType = $object->objectType == 'case' ? 'testcase' : $object->objectType;?>
    <?php if(!in_array($objectType, $config->noWebModules)):?>
    <a href='<?php echo $object->url;?>' class="item item-contract multi-lines">
      <div class="content">
        <span class="title"><?php echo $object->title?></span>
        <?php echo "<small class='muted'>[{$lang->searchObjects[$objectType]} #{$object->objectID}]</small> ";?>
        <div class='muted'><?php echo $object->summary?></div>
      </div>
    </a>
    <?php endif;?>
    <?php endforeach;?>
  </div>
  <nav class='nav justified pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</div>
<script>
$(function(){$('body').removeClass('with-nav-top');})
</script>
<?php include '../../common/view/m.footer.html.php';?>
