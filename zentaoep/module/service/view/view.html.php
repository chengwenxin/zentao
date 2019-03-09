<?php
/**
 * The edit view file of service module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     service
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2>
      <span class='label label-id'><?php echo $service->id;?></span>
      <?php echo $service->name?>
      <span class='label label-info'><?php echo $service->version?></span>
    </h2>
  </div>
  <div class='table-row'>
    <div class='main-col col-8'>
      <div class='cell'>
        <div class='detail'>
          <div class='detail-title'><?php echo $lang->service->host?></div>
          <div class='detail-content'>
            <?php
            if($service->hosts)
            {
                foreach(explode(',', $service->hosts) as $host) echo zget($hosts, $host, '') . ' ';
            }
            ?>
          </div>
        </div>
        <div class='detail'>
          <div class='detail-title'><?php echo $lang->service->desc?></div>
          <div class='detail-content'><?php echo $service->desc;?></div>
        </div>
        <?php include '../../common/view/action.html.php'?>
      </div>
      <div class='main-actions'>
        <div class='btn-toolbar'>
          <?php
          common::printLink('service', 'edit', "serviceID={$service->id}", "<i class='icon-pencil'></i> " . $lang->edit, '', "class='btn'");
          common::printLink('service', 'delete', "serviceID={$service->id}", "<i class='icon-trash'></i> " . $lang->delete, 'hiddenwin', "class='btn'");
          ?>
        </div>
      </div>
    </div>
    <div class='side-col col-4'>
      <div class='cell'>
        <div class='detail'>
          <div class='detail-title'><?php echo $lang->service->basicInfo?></div>
          <table class='table table-data table-condensed table-borderless'>
            <tr>
              <th class='w-80px'><?php echo $lang->service->dept?></th>
              <td><?php echo $depts[$service->dept]?></td>
            </tr>
            <tr>
              <th><?php echo $lang->service->type?></th>
              <td><?php echo $lang->service->typeList[$service->type]?></td>
            </tr>
            <tr>
              <th><?php echo $lang->service->devel?></th>
              <td><?php echo $users[$service->devel]?></td>
            </tr>
            <tr>
              <th><?php echo $lang->service->qa?></th>
              <td><?php echo $users[$service->qa]?></td>
            </tr>
            <tr>
              <th><?php echo $lang->service->ops?></th>
              <td><?php echo $users[$service->ops]?></td>
            </tr>
            <tr>
              <th><?php echo $lang->service->softName?></th>
              <td><?php echo $service->softName . " <span class='label label-info'>{$service->softVersion}</span>"?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id='mainActions' class='main-actions'>
  <nav class='container'></nav>
</div>
<?php include '../../common/view/footer.html.php';?>
