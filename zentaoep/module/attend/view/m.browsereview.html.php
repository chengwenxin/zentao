<?php
/**
 * The browse review mobile view file of attend module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     attend 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}
include "../../common/view/m.header.html.php";?>
<style>.align-middle td{vertical-align: middle;}</style>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('attend', 'browsereview');?>
  <div class='box' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered'>
      <thead>
        <tr>
         <th class='w-70px text-center'><?php echo $lang->attend->account;?></th>
         <th class='text-center'><?php echo $lang->attend->manualIn;?></th>
         <th class='text-center'><?php echo $lang->attend->status;?></th>
         <th class='w-120px text-center'><?php echo $lang->actions;?></th>
        </tr>
      </thead>
      <?php foreach($attends as $attend):?>
      <?php if(!isset($users[$attend->account])) continue;?>
      <?php $user = $users[$attend->account];?>
      <tr class='text-center align-middle' data-id='<?php echo $attend->id;?>'>
        <td><?php echo $user->realname;?></td>
        <td><?php echo substr($attend->manualIn, 0, 5);?></td>
        <td><?php echo zget($lang->attend->statusList, $attend->status);?></td>
        <td>
          <?php 
          if(commonModel::hasPriv('oa.attend', 'review')) 
          {
              echo "<a class='btn btn-xs success' data-remote='" . inlink('review', "id={$attend->id}&status=pass")   . "' data-display='ajaxAction' data-confirm='{$lang->attend->confirmReview['pass']}' data-locate='self'>{$lang->attend->reviewStatusList['pass']}</a>";
              echo "<a class='btn btn-xs warning' data-remote='" . inlink('review', "id={$attend->id}&status=reject") . "' data-display='modal' data-placement='bottom' data-confirm='{$lang->attend->confirmReview['reject']}'>{$lang->attend->reviewStatusList['reject']}</a>";
          }
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</section>

<?php include "../../common/view/m.footer.html.php";?>
