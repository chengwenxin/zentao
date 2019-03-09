<div class='heading divider'>
  <span class='title'>
    <input type='text' class='input' id='search' value='' placeholder='<?php echo $this->app->loadLang('search')->search->common;?>'/>
  </span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
<?php js::set('productID', $productID);?>
<?php js::set('module', $module);?>
<?php js::set('method', $method);?>
<?php js::set('extra', $extra);?>
</div>
<div id='searchResult'>
  <div id='defaultMenu' class='search-list'>
    <div class='list'>
      <?php
      foreach($modules as $moduleID => $module)
      {
          echo html::a(sprintf($link, $productID, $moduleID), $module, '', "class='text-important item' data-id='{$moduleID}' data-key='{$modulesPinyin[$module]}'");
      }
      ?>
    </div>
  </div>
</div>
