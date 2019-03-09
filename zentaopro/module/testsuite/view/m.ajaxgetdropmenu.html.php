<div class='heading divider'>
  <span class='title'>
    <input type='text' class='input' id='search' value='' placeholder='<?php echo $this->app->loadLang('search')->search->common;?>'/>
  </span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>

<div id='searchResult' class='content'>
  <div id='defaultMenu' class='search-list'>
    <div id='activedItems'>
      <div class='list'>
        <?php
        foreach($libraries as $libID => $libName)
        {
            echo html::a(sprintf($link, $libID), "<i class='icon-database'></i> " . $libName, '', "class='text-important item' data-id='{$libID}' data-key='{$librariesPinyin[$libName]}'");
        }
        ?>
      </div>
    </div>
  </div>
</div>
