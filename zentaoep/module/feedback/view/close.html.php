<?php
/**
 * The comment view file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     feedback
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->feedback->close;?></h2>
  </div>
  <form method='post' target='hiddenwin'>
    <table class='table table-form'>
      <tr class='<?php echo (!empty($this->app->user->feedback) or $this->cookie->feedbackView) ? 'hidden' : ''?>'>
        <th><?php echo $lang->feedback->closedReason?></th>
        <td><?php echo html::select('closedReason', $lang->feedback->closedReasonList, $closedReason, "class='form-control w-200px'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->comment?></th>
        <td><?php echo html::textarea('comment', '',"rows='5' class='w-p100'");?></td>
      </tr>
      <tr>
        <td colspan='2' class='text-center form-actions'>
          <?php echo html::submitButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.lite.html.php';?>
