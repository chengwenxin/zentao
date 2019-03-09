<?php
/**
 * The browse mobile view file of release module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     release
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<section id='page' class='section list-with-pager'>
  <div class='heading'>
    <div class='title'>
      <strong><?php echo $lang->release->browse;?></strong>
      <?php if($product->type !== 'normal') echo '<span class="label label-info">' . $branches[$branch] . '</span>';?>
    </div>
  </div>
  <?php $refreshUrl = $this->createLink('release', 'browse', "productID={$product->id}&branch=$branch");?>
  <div data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead class='text-center'>
        <tr>
          <th><?php echo $lang->release->name;?></th>
          <th class='w-100px'><?php echo $lang->release->date;?></th>
          <th class='w-80px'><?php echo $lang->release->status;?></th>
        </tr>
      </thead>
      <?php foreach($releases as $release):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('release', 'view', "id={$release->id}")?>' data-id='<?php echo$release->id;?>'>
        <td class='text-left'>
        <?php if($product->type != 'normal') echo "<span class='label label-branch label-badge'>{$branches[$release->branch]}</span>"?>
        <?php echo $release->name;?>
        </td>
        <td><?php echo $release->date;?></td>
        <td><?php echo $lang->release->statusList[$release->status];?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</section>
<?php include '../../common/view/m.footer.html.php';?>
