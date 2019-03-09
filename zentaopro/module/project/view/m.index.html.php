<?php $bodyClass = 'with-nav-bottom';?>
<?php include '../../common/view/m.header.html.php';?>
<?php if(empty($projects)):?>
<div class="text-center">
  <p><span class="text-muted"><?php echo $lang->project->noProject;?></span></p>
</div>
<?php else:?>
<?php echo $this->fetch('block', 'dashboard', 'module=project');?>
<?php endif;?>
<?php include '../../common/view/m.footer.html.php';?>
