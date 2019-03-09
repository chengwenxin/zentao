<?php
/**
 * The index view file of sms module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     sms
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include $this->app->getModuleRoot() . 'message/view/header.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='center-block'>
    <div class='main-header'>
      <h2><?php echo $lang->sms->common;?><h2>
    </div>
    <form method='post' target='hiddenwin'>
        <table class='table table-form'>
          <tr>
            <th class='w-120px'><?php echo $lang->sms->turnon?></th>
            <td><?php echo html::radio('turnon', $lang->sms->turnonList, empty($smsConfig->turnon) ? '' : $smsConfig->turnon)?></td>
            <td></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->debug?></th>
            <td><?php echo html::radio('debug', $lang->sms->turnonList, empty($smsConfig->debug) ? '' : $smsConfig->debug)?></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->method?></th>
            <td><?php echo html::radio('method', $lang->sms->methodList, empty($smsConfig->method) ? '' : $smsConfig->method)?></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->url?></th>
            <td><?php echo html::input('url', empty($smsConfig->url) ? '' : $smsConfig->url, "class='form-control'")?></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->encode?></th>
            <td><?php echo html::input('encode', empty($smsConfig->encode) ? 'utf-8' : $smsConfig->encode, "class='form-control'")?></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->mobile?></th>
            <td><?php echo html::input('mobile', empty($smsConfig->mobile) ? '' : $smsConfig->mobile, "class='form-control'")?></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->delimiter?></th>
            <td><?php echo html::input('delimiter', empty($smsConfig->delimiter) ? '' : $smsConfig->delimiter, "class='form-control'")?></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->content?></th>
            <td><?php echo html::input('content', empty($smsConfig->content) ? '' : $smsConfig->content, "class='form-control'")?></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->signature?></th>
            <td><?php echo html::input('signature', empty($smsConfig->signature) ? '' : $smsConfig->signature, "class='form-control'")?></td>
          </tr>
          <tr>
            <th><?php echo $lang->sms->successCall?></th>
            <td><?php echo html::input('successcall', empty($smsConfig->successcall) ? '' : $smsConfig->successcall, "class='form-control'")?></td>
          </tr>
          <tr class='otherItems'>
            <th><?php echo $lang->sms->otherItems;?></th>
            <td colspan='2'>
              <table class='table table-form'>
                <?php if(!empty($smsConfig->params)):?>
                <?php foreach($smsConfig->params as $key => $value):?>
                <tr>
                  <td><?php echo html::input('key[]', $key, "class='form-control'")?></td>
                  <td><?php echo html::input('value[]', $value, "class='form-control'")?></td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
                <?php for($i = 1; $i <= 5; $i++):?>
                <tr>
                  <td><?php echo html::input('key[]', '', "class='form-control' placeholder='{$lang->sms->key}'")?></td>
                  <td><?php echo html::input('value[]', '', "class='form-control' placeholder='{$lang->sms->value}'")?></td>
                </tr>
                <?php endfor;?>
              </table>
            </td>
          </tr>
          <tr class='text-center form-actions'>
            <td colspan='3'>
            <?php echo html::submitButton() . html::linkButton($lang->sms->reset, inlink('reset'), '', '', 'btn btn-wide');?>
            <?php echo html::a(inlink('test'), $lang->sms->test, 'hiddenwin', "class='btn btn-wide'");?>
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
