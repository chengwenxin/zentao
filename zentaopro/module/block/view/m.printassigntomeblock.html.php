<?php
/**
 * The assigntome block view file of block module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class="row">
  <?php $active = key($hasViewPriv);?>
  <nav class="nav" data-display data-selector="a" data-show-single="true" data-active-class="active">
    <?php foreach($hasViewPriv as $type => $bool):?>
    <?php if($config->global->flow != 'full' && $config->global->flow != 'onlyTask' && $type == 'task') continue;?>
    <?php if($config->global->flow != 'full' && $config->global->flow != 'onlyTest' && $type == 'bug') continue;?>
    <a href="###" data-target="#<?php echo $type?>" data-toggle="tab"<?php if($type == $active) echo " class='active'"?>><?php echo $lang->block->availableBlocks->$type?></a>
    <?php endforeach;?>
  </nav>
  <div style='padding:0px;width:100%'>
    <?php foreach($hasViewPriv as $type => $bool):?>
    <?php if($config->global->flow != 'full' && $config->global->flow != 'onlyTask' && $type == 'task') continue;?>
    <?php if($config->global->flow != 'full' && $config->global->flow != 'onlyTest' && $type == 'bug') continue;?>
    <div class="box <?php echo $type == $active ? "in" : 'hidden'?>" id="<?php echo $type?>" style='padding:0px;'>
  	<?php include "m.{$type}block.html.php";?>
    </div>
    <?php endforeach;?>
  </div>
</div>
