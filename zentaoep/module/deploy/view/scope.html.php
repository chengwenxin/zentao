<?php
/**
 * The scope view file of deploy module of ZenTaoPMS.
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
<div id='mainMenu' class='clearfix'>
  <?php include './nav.html.php';?>
  <div class='btn-toolbar pull-right'>
    <?php
    $browseLink = $this->session->stepList ? $this->session->stepList :  inlink('steps', "deployID=$deploy->id");
    $params     = "deployID=$deploy->id";
    common::printLink('deploy', 'manageScope', $params, $lang->deploy->manageScope, '', "class='btn btn-primary'");
    echo html::linkButton("<i class='icon-level-up icon-large icon-rotate-270'></i> " . $lang->goback, $browseLink);
    ?>
  </div>
</div>
<div class='main-content'>
  <table class='table table-bordered'>
    <thead>
      <tr>
        <th><?php echo $lang->deploy->service?></th>
        <th><?php echo $lang->deploy->hadHost?></th>
        <th><?php echo $lang->deploy->removeHost?></th>
        <th><?php echo $lang->deploy->addHost?></th>
      <tr>
    </thead>
    <tbody>
      <?php foreach($scope as $item):?>
      <tr>
        <td title='<?php echo $optionMenu[$item->service]?>'><?php echo $optionMenu[$item->service]?></td>
        <td><?php foreach(explode(',', $item->hosts) as $hostID) echo zget($hosts, $hostID, '') . ' ';?></td>
        <td><?php foreach(explode(',', $item->remove) as $hostID) echo zget($hosts, $hostID, '') . ' ';?></td>
        <td><?php foreach(explode(',', $item->add) as $hostID) echo zget($hosts, $hostID, '') . ' ';?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.html.php';?>
