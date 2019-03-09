<?php
/**
 * The build browse mobile view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     project
 * @version     $Id
 * @link        http://www.zentao.net
 */

include "../../common/view/m.header.html.php";
?>

<div class='heading'>
  <div class='title'>
    <strong><?php echo $lang->project->build;?></strong>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <div class='box'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->build->product;?></th>
          <th><?php echo $lang->build->name;?></th>
          <th class='text-center w-140px'><?php echo $lang->build->date;?></th>
        </tr>
      </thead>
      <?php foreach($projectBuilds as $builds):?>
      <?php foreach($builds as $build):?>
      <tr class= 'text-center' data-id='<?php echo $build->id ?>' data-url='<?php echo $this->createLink('build', 'view', 'buildID=' . $build->id);?>'>
        <td class='text-left'><?php echo $build->productName;?></td>
        <td class='text-left'><?php echo $build->name;?></td>
        <td><?php echo $build->date;?></td>
      </tr>
      <?php endforeach;?>
      <?php endforeach;?>
    </table>
  </div>
</section>

<?php include "../../common/view/m.footer.html.php"; ?>
