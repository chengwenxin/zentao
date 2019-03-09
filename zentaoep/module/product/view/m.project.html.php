<?php
/**
 * The project mobile view file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$bodyClass = 'with-menu-top';
?>
<?php include '../../common/view/m.header.html.php';?>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php echo html::a('###', $lang->product->project);?>
</nav>
<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('product', 'project', http_build_query($this->app->getParams()));?>
  <div class='box' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->project->name;?></th>
          <th class='w-100px'><?php echo $lang->project->end;?></th>
          <th class='w-80px'><?php echo $lang->project->status;?></th>
          <th class='w-50px'><?php echo $lang->project->progress;?></th>
        </tr>
      </thead>
      <?php foreach($projectStats as $project):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('project', 'task', "project=$project->id")?>'>
        <td class='text-left'><?php echo $project->name;?></td>
        <td><?php echo $project->end;?></td>
        <?php if(isset($project->delay)):?>
        <td class='status-delay'><?php echo $lang->project->delayed;?></td>
        <?php else:?>
        <td class='status-<?php echo $project->status?>'><?php echo $lang->project->statusList[$project->status];?></td>
        <?php endif;?>
        <td><?php echo $project->hours->progress . '%';?></td>
     </tr>
     <?php endforeach;?>
    </table>
  </div>
</section>
<?php include '../../common/view/m.footer.html.php';?>
