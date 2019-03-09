<?php
/**
 * The edit view file of mail module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <wwccss@cnezsoft.com>
 * @package     mail
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include $this->app->getModuleRoot() . 'message/view/header.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='center-block mw-800px'>
    <div class='main-header'>
      <h2>
        <?php echo $lang->mail->common;?>
        <small class='text-muted'> <?php echo $lang->arrow . $lang->mail->edit;?></small>
      </h2>
    </div>
    <form method='post' action='<?php echo inlink('save');?>' id='dataform'>
      <table class='table table-form'>
        <tr>
          <th class='rowhead w-130px'><?php echo $lang->mail->turnon; ?></th>
          <td class='w-p25-f'><?php echo html::radio('turnon', $lang->mail->turnonList, 1);?></td>
          <td></td>
          <td></td>
        </tr>
        <?php if(!empty($config->global->cron)):?>
        <tr>
          <th class='text-top'><?php echo $lang->mail->async?></th>
          <td><?php echo html::radio('async', $lang->mail->asyncList, zget($config->mail, 'async', 0))?></td>
        </tr>
        <?php endif;?>
        <tr>
          <th><?php echo $lang->mail->fromAddress; ?></th>
          <td><?php echo html::input('fromAddress', $mailConfig->fromAddress, "class='form-control' autocomplete='off'");?></td>
          <td colspan='2'><?php echo $lang->mail->addressWhiteList?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->fromName; ?></th>
          <td colspan='3'>
            <div class='required required-wrapper'></div>
            <?php echo html::input('fromName', $mailConfig->fromName, "class='form-control' autocomplete='off'");?>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->domain; ?></th>
          <td colspan='3'><?php echo html::input('domain', $mailConfig->domain, "class='form-control' autocomplete='off'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->host; ?></th>
          <td colspan='3'><?php echo html::input('host', $mailConfig->host, "class='form-control' autocomplete='off'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->port; ?></th>
          <td><?php echo html::input('port', $mailConfig->port, "class='form-control' autocomplete='off'");?></td>
          <th class='w-70px'><?php echo $lang->mail->secure; ?></th>
          <td>
          <?php
          if(!$openssl)
          {
              unset($lang->mail->secureList['ssl']);
              unset($lang->mail->secureList['tls']);
              $mailConfig->secure = '';
          }
          echo html::radio('secure', $lang->mail->secureList, $mailConfig->secure);
          if(!$openssl) echo " &nbsp; <span class='text-warning'>" . $lang->mail->disableSecure . '</span>';
          ?>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->auth; ?></th>
          <td colspan='3'><?php echo html::radio('auth', $lang->mail->authList, $mailConfig->auth); ?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->username; ?></th>
          <td colspan='3'><?php echo html::input('username', $mailConfig->username, "class='form-control' autocomplete='off'") ?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->password; ?></th>
          <td colspan='3'><?php echo html::password('password', $mailConfig->password, "class='form-control' autocomplete='off' placeholder='{$lang->mail->placeholder->password}'") ?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->debug; ?></th>
          <td><?php echo html::radio('debug', $lang->mail->debugList, $mailConfig->debug);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->charset; ?></th>
          <td><?php echo html::radio('charset', $config->charsets[$this->cookie->lang], $mailConfig->charset);?></td>
        </tr>
  
        <tr>
          <td colspan='2' class='text-center'>
            <?php 
            echo html::submitButton();
            if($config->mail->turnon and $mailExist) echo html::linkButton($lang->mail->test, inlink('test'));
            echo html::linkButton($lang->mail->reset, inlink('reset'));
            if(common::hasPriv('mail', 'browse') and !empty($config->mail->async) and !empty($config->global->cron)) echo html::linkButton($lang->mail->browse, inlink('browse'));
            ?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
