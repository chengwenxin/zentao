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
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2>
      <strong><?php echo $deploy->name . $lang->colon . $lang->deploy->manageScope;?></strong>
    </h2>
    <div class='pull-right btn-toolbar'><?php echo html::backButton('', '', 'btn');?></div>
  </div>
  <div class='main'>
    <form method='post' target='hiddenwin'>
      <table class='table table-form table-fixed'>
        <thead>
          <tr>
            <th><?php echo $lang->deploy->service?></th>
            <th><?php echo $lang->deploy->hadHost?></th>
            <th><?php echo $lang->deploy->removeHost?></th>
            <th><?php echo $lang->deploy->addHost?></th>
            <th class='w-120px'></th>
          <tr>
        </thead>
        <tbody>
          <?php $i = 1;?>
          <?php if($scope):?>
          <?php foreach($scope as $item):?>
          <tr>
            <td style='overflow: visible'><?php echo html::select("service[$i]", $optionMenu, $item->service, "class='form-control chosen' onchange='loadHost(this)'")?></td>
            <?php
            $service = zget($services, $item->service, '');
            $serviceHosts = $service->hosts . ',' . $item->hosts;
            $hostPairs    = array('' => '');
            if($serviceHosts)
            {
                foreach(explode(',', $serviceHosts) as $hostID)
                {
                    if(!isset($hosts[$hostID])) continue;
                    $hostPairs[$hostID] = $hosts[$hostID];
                }
            }
            ?>
            <td style='overflow: visible'><?php echo html::select("hosts[$i][]", $hostPairs, $item->hosts, "class='form-control chosen' multiple");?></td>
            <td style='overflow: visible'><?php echo html::select("remove[$i][]", $hostPairs, $item->remove, "class='form-control chosen' multiple");?></td>
            <td style='overflow: visible'><?php echo html::select("add[$i][]", $hosts, $item->add, "class='form-control chosen' multiple");?></td>
            <td>
              <div class='btn-group'>
                <?php echo html::commonButton("<i class='icon icon-plus'></i>", "onclick='addItem(this)'");?>
                <?php echo html::commonButton("<i class='icon icon-trash'></i>", "onclick='removeItem(this)'");?>
              </div>
            </td>
          </tr>
          <?php $i++; ?>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td style='overflow: visible'><?php echo html::select("service[$i]",   $optionMenu, '', "class='form-control chosen' onchange='loadHost(this)'")?></td>
            <td style='overflow: visible'><?php echo html::select("hosts[$i][]",   $hosts, '', "class='form-control chosen' multiple");?></td>
            <td style='overflow: visible'><?php echo html::select("remove[$i][]", $hosts, '', "class='form-control chosen' multiple");?></td>
            <td style='overflow: visible'><?php echo html::select("add[$i][]",  $hosts, '', "class='form-control chosen' multiple");?></td>
            <td>
              <div class='btn-group'>
                <?php echo html::commonButton("<i class='icon icon-plus'></i>", "onclick='addItem(this)'");?>
                <?php echo html::commonButton("<i class='icon icon-trash'></i>", "onclick='removeItem(this)'");?>
              </div>
            </td>
          </tr>
          <?php $i++; ?>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan='5' class='text-center form-actions'>
              <?php echo html::submitButton();?>
              <?php echo html::backButton();?>
            </td>
          </tr>
        </tfoot>
      </table>
    </form>
  </div>
</div>
<?php js::set('index', $i);?>
<?php include '../../common/view/footer.html.php';?>
