<div class='heading divider'>
  <span class='title'>
    <input type='text' class='input' id='search' value='' placeholder='<?php echo $this->app->loadLang('search')->search->common;?>'/>
  </span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>
<?php js::set('productID', $productID);?>
<?php js::set('module', $module);?>
<?php js::set('method', $method);?>
<?php js::set('extra', $extra);?>
<div id='searchResult' class='content'>
  <div id='defaultMenu' class='search-list'>
    <div class='list'>
    <?php
    foreach($branches as $branchID => $branch)
    {
        echo html::a(sprintf($link, $productID, $branchID), "<i class='icon-cube'></i>&nbsp;{$branch}", '', "class='text-important item' data-id='{$branchID}' data-key='{$branchesPinyin[$branch]}'");
    }
    ?>
    </div>
  </div>
</div>
