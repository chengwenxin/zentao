<div class='heading divider'>
  <span class='title'>
    <input type='text' class='input' id='search' value='' placeholder='<?php echo $this->app->loadLang('search')->search->common;?>'/>
  </span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>
<?php js::set('projectID', $projectID);?>
<?php js::set('module', $module);?>
<?php js::set('method', $method);?>
<?php js::set('extra', $extra);?>
<div id='searchResult' class='content'>
  <div id='defaultMenu' class='search-list'>
    <div id='activedItems'>
    <?php
    $iCharges = 0;
    $others   = 0;
    $dones    = 0;
    foreach($projects as $project)
    {
        if($project->status != 'done' and $project->PM == $this->app->user->account) $iCharges++;
        if($project->status != 'done' and !($project->PM == $this->app->user->account)) $others++;
        if($project->status == 'done') $dones++;
    }
 
    if($iCharges and $others) echo "<li class='heading'>{$lang->project->mine}</li>";
    echo "<div class='list'>";
    foreach($projects as $id => $project)
    {
        if($project->status != 'done' and $project->PM == $this->app->user->account)
        {
            echo html::a(sprintf($link, $project->id), "<i class='icon-folder-close-alt'></i>&nbsp;{$project->name}", '', "class='mine text-important item' data-id='{$project->id}' data-tag=':{$project->status} @{$project->PM} @mine' data-key='{$project->key}'");
            unset($projects[$id]);
        }
    }
    echo '</div>';
 
    if($iCharges and $others) echo "<div class='heading'>{$lang->project->other}</div>";
    $class = ($iCharges and $others) ? "other" : '';
    echo "<div class='list'>";
    foreach($projects as $id => $project)
    {
        if($project->status != 'done' and !($project->PM == $this->app->user->account))
        {
            echo html::a(sprintf($link, $project->id), "<i class='icon-folder-close-alt'></i>&nbsp;{$project->name}", '', "class='$class item' data-id='{$project->id}' data-tag=':{$project->status} @{$project->PM}' data-key='{$project->key}'");
            unset($projects[$id]);
        }
    }
    echo '</div>';
    ?>
    </div>
 
    <?php if($dones):?>
    <div class='box'>
      <a class='btn fluid' id='closedCollapse'><?php echo $lang->project->doneProjects;?></a>
      <div class="collapse hidden" id="doneProjects">
        <div class="list">
          <?php
          foreach($projects as $project)
          {
              if($project->status == 'done') echo html::a(sprintf($link, $project->id), "<i class='icon-folder-close-alt'></i> {$project->name}", '', "data-id='{$project->id}' data-tag=':{$project->status} @{$project->PM}' data-key='{$project->key}' class='done item'");
          }
          ?>
        </div>
      </div>
    </div>
    <script>
    $(function()
    {
        $('.modal #closedCollapse').click(function()
        {
            if($('.modal #doneProjects').hasClass('hidden'))
            {
                $('.modal #doneProjects').removeClass('hidden');
                $('.modal #doneProjects').addClass('in');
            }
            else
            {
                $('.modal #doneProjects').removeClass('in');
                $('.modal #doneProjects').addClass('hidden');
            }
        })
        if($(window).height() < $('.modal #activedItems').height() + $('.modal .heading.divider').height())
        {
            $('.modal #searchResult').addClass('with-closed');
            $('.modal #closedCollapse').closest('.box').addClass('affix').addClass('dock-bottom');
        }
    })
    </script>
    <?php endif;?>
  </div>
</div>
