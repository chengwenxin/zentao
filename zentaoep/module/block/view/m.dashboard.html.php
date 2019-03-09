<style>
  tbody > tr > td{word-break:break-all;}
</style>
<div id='blocks' class='blocks'>
  <?php
  $blocks = $longBlocks + $shortBlocks;
  $index = 0;
  reset($blocks);
  ?>
  <?php foreach($blocks as $key => $block):?>
  <?php if(strpos(',overview,welcome,flowchart,calendar,report,', ",{$block->block},") !== false) continue; ?>
  <?php if($block->source == 'qa' && $block->block == 'statistic') continue;?>
  <?php if(isset($config->block->closed) and strpos(",{$config->block->closed},", ",{$block->source}|{$block->block},") !== false) continue;?>
  <?php $index = $key; ?>
  <div class='section' id='block<?php echo $block->id ?>' data-code='<?php echo $block->block ?>' data-id='<?php echo $index ?>' data-url='<?php echo $block->blockLink;?>'>
    <?php if($block->block == 'html' or $block->block == 'dynamic'):?>
    <div class='heading'>
      <strong class='title <?php if(isset($block->params->color)) echo 'text-' . $block->params->color; else echo 'text-gray'?>'><?php echo $block->title ?></strong>
      <?php if(isset($block->moreLink)):?>
      <nav class='nav small hidden'>
        <?php echo html::a($block->moreLink, $lang->more . "&nbsp;<i class='icon-double-angle-right'></i>"); ?>
      </nav>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class='content listen-scroll<?php if($block->block == 'html') echo ' article has-padding'; ?>' data-display='self' data-remote='<?php echo $this->createLink('block', 'printBlock', 'index=' . $index) ?>'>
    </div>
  </div>
  <?php endforeach; ?>
</div>
