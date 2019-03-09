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
<?php include '../../common/view/kindeditor.html.php';?>
<style>
.input-group-addon{border-left:0px;}
</style>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2>
      <span class='label label-id'><?php echo $service->id;?></span>
      <?php echo $service->name;?>
      <small><?php echo $lang->arrow . $lang->service->edit?></small>
    </h2>
  </div>
  <form method='post' target='hiddenwin'>
    <table class='table table-form'>
      <tr>
        <th class='w-100px'><?php echo $lang->service->name?></th>
        <td colspan='2'>
          <div class='table-row'>
            <div class='table-col'>
              <div class="input-control has-icon-right required">
                <div class="colorpicker">
                  <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown"><span class="cp-title"></span><span class="color-bar"></span><i class="ic"></i></button>
                  <ul class="dropdown-menu clearfix">
                    <li class="heading"><?php echo $lang->service->colorTag;?><i class="icon icon-close"></i></li>
                  </ul>
                  <input type="hidden" class="colorpicker" id="color" name="color" value="<?php echo $service->color;?>" data-icon="color" data-wrapper="input-control-icon-right" data-update-color="#name"  data-provide="colorpicker">
                </div>
                <?php echo html::input('name', $service->name, "class='form-control' autocomplete='off'");?>
              </div>
            </div>
            <div class='table-col w-150px'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->service->version?></span>
                <?php echo html::input('version', $service->version, "class='form-control'")?>
              </div>
            </div>
          </div>
        </td>
        <td class='w-400px'></td>
      </tr>
      <tr>
        <th><?php echo $lang->service->softName?></th>
        <td colspan='2'>
          <div class='table-row'>
            <div class='table-col'><?php echo html::input('softName', $service->softName, "class='form-control'")?></div>
            <div class='table-col w-150px'>
              <div class='input-group'>
                <span class='input-group-addon'><?php echo $lang->service->softVersion?></span>
                <?php echo html::input('softVersion', $service->softVersion, "class='form-control'")?>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->service->dept?></th>
        <td class='w-250px'><?php echo html::select('dept', $depts, $service->dept, "class='form-control chosen'")?></td>
        <td></td><td></td>
      </tr>
      <tr>
        <th><?php echo $lang->service->devel?></th>
        <td><?php echo html::select('devel', $users, $service->devel, "class='form-control chosen'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->service->qa?></th>
        <td><?php echo html::select('qa', $users, $service->qa, "class='form-control chosen'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->service->ops?></th>
        <td><?php echo html::select('ops', $users, $service->ops, "class='form-control chosen'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->service->type?></th>
        <?php if($service->parent == 0) unset($lang->service->typeList['component']);?>
        <td><?php echo html::radio('type', $lang->service->typeList, $service->type)?></td>
      </tr>
      <tr>
        <th><?php echo $lang->service->host?></th>
        <td colspan='3'><?php echo html::select('hosts[]', $hosts, $service->hosts, "class='form-control chosen' multiple")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->service->desc?></th>
        <td colspan='3'><?php echo html::textarea('desc', $service->desc, "class='form-control'")?></td>
      </tr>
      <tr>
        <td colspan='4' class='text-center form-actions'>
          <?php echo html::submitButton();?>
          <?php echo html::backButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
