<?php
/**
 * The project browse mobile view file of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     my
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */
?>

<?php include "../../common/view/m.header.html.php";?>

<section id='page' class='section list-with-pager'>
  <div class='box'>
    <table class='table bordered'>
      <thead>
        <tr>
          <th><?php echo $lang->project->name;?></th>
          <th class='text-center w-70px'><?php echo $lang->statusAB;?></th>
          <th class='text-center w-100px'><?php echo $lang->project->end;?></th>
        </tr>
      </thead>
      <?php foreach($projects as $project):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('project', 'task', "projectID={$project->id}");?>' data-id='<?php echo $project->id;?>'>
        <td class='text-left'><?php echo $project->name;?> </td>
        <?php if(isset($project->delay)):?>
        <td class='project-delayed'><?php echo $lang->project->delayed;?></td>
        <?php else:?>
        <td class='project-<?php echo $project->status;?>'><?php echo zget($lang->project->statusList, $project->status);?></td>
        <?php endif;?>
        <td><?php echo $project->end;?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</section>

<?php include "../../common/view/m.footer.html.php"; ?>
