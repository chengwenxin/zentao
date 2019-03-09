<?php
/**
 * The view view file of deploy module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     deploy
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainMenu' class='clearfix'>
  <?php include './nav.html.php';?>
</div>

<div id='mainContent' class='main-row'>
  <div class='main-col col-8'>
    <div class='cell'>
      <div class='detail'>
        <div class='detail-title'><?php echo $lang->deploy->desc;?></div>
        <div class='detail-content article-content'><?php echo $deploy->desc;?></div>
      </div>
      <?php if($deploy->products):?>
      <div class='detail'>
        <table class='table table-condensed' style='border:0px;'>
        <tr><th><?php echo $lang->deploy->product?></th><th><?php echo $lang->deploy->release?></th><th><?php echo $lang->deploy->package?></th></tr>
        <?php
        foreach($deploy->products as $deployProduct)
        {
            $product = zget($products, $deployProduct->product, '');
            $release = zget($releases, $deployProduct->release, '');
            echo "<tr><td>" . zget($product, 'name', '') . "</td><td>" . zget($release, 'name', '') . "</td><td>{$deployProduct->package}</td></tr>";
        }
        ?>
        </table>
      </div>
      <?php endif;?>
      <?php $actionFormLink = $this->createLink('action', 'comment', "objectType=deploy&objectID=$deploy->id");?>
      <?php include '../../common/view/action.html.php';?>
    </div>
    <div class='main-actions'>
      <div class="btn-toolbar">
        <?php $browseLink = inlink('steps', "deployID=$deploy->id");?>
        <?php $params     = "deployID=$deploy->id";?>
        <?php common::printBack($browseLink);?>
        <?php if(!$deploy->deleted):?>
        <div class='divider'></div>
        <?php
        common::printIcon('deploy', 'finish',   $params, $deploy, 'button');
        common::printIcon('deploy', 'activate', $params, $deploy, 'button');
        ?>
    
        <div class='divider'></div>
        <?php
        common::printIcon('deploy', 'edit', $params, $deploy);
        common::printIcon('deploy', 'delete', $params, $deploy, 'button', '', 'hiddenwin');
        ?>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class='side-col col-4'>
    <div class='cell'>
      <div class='detail'>
        <div class='detail-title'><?php echo $lang->deploy->lblBasic;?></div>
        <table class='table table-data table-condensed table-borderless table-fixed'>
          <tr valign='middle'>
            <th class='w-60px'><?php echo $lang->deploy->owner;?></th>
            <td><?php echo zget($users, $deploy->owner);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->deploy->lblBeginEnd;?></th>
            <td><?php echo substr($deploy->begin, 0, 16) . ' ~ ' . substr($deploy->end, 0, 16);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->deploy->members;?></th>
            <td><?php foreach(explode(',', $deploy->members) as $user) echo zget($users, $user) . ' ';?></td>
          </tr>
          <tr>
            <th><?php echo $lang->deploy->status;?></th>
            <td><?php echo zget($lang->deploy->statusList, $deploy->status);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->deploy->createdBy;?></th>
            <td><?php echo zget($users, $deploy->createdBy) . $lang->at . $deploy->createdDate;?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="mainActions" class='main-actions'>
  <nav class='container'></nav>
</div>

<?php include '../../common/view/footer.modal.html.php';?>
