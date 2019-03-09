<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
  <?php
    if(!isset($type))   $type   = 'today';
    if(!isset($period)) $period = 'today';
    $date = isset($date) ? $date : helper::today();

    echo "<div class='input-control w-120px'>" . $userList . "</div>";

    $methodName = $this->app->getMethodName();

    if($config->global->flow == 'full')
    {
        $label  = "<span class='text'>{$lang->user->schedule}</span>";
        if(common::hasPriv('user', 'todo'))
        {
            $link = $this->createLink('user', 'todo', "account=$account");
            $active = $methodName == 'todo' ? ' btn-active-text' : '';
        }
        elseif(common::hasPriv('user', 'effort'))
        {
            $link = $this->createLink('user', 'effort', "account=$account");
            $active = $methodName == 'effort' ? ' btn-active-text' : '';
        }
        if($link) echo html::a($link, $label, '', "class='btn btn-link $active todoTab'");
    }

    if($config->global->flow != 'onlyTask' and $config->global->flow != 'onlyTest')
    {
        $label  = "<span class='text'>{$lang->user->story}</span>";
        $active = $methodName == 'story' ? ' btn-active-text' : '';
        common::printLink('user', 'story', "account=$account", $label, '', "class='btn btn-link $active storyTab'");
    }

    if($config->global->flow == 'full' or $config->global->flow == 'onlyTask') 
    {
        $label  = "<span class='text'>{$lang->user->task}</span>";
        $active = $methodName == 'task' ? ' btn-active-text' : '';
        common::printLink('user', 'task', "account=$account", $label, '', "class='btn btn-link $active taskTab'");
    }

    if($config->global->flow == 'full' or $config->global->flow == 'onlyTest') 
    {
        $label  = "<span class='text'>{$lang->user->bug}</span>";
        $active = $methodName == 'bug' ? ' btn-active-text' : '';
        common::printLink('user', 'bug', "account=$account", $label, '', "class='btn btn-link $active bugTab'");

        $label  = "<span class='text'>{$lang->user->test}</span>";
        $active = ($methodName == 'testtask' or $methodName == 'testcase')? ' btn-active-text' : '';
        common::printLink('user', 'testtask', "account=$account", $label, '', "class='btn btn-link $active testtaskTab'");
    }

    $label  = "<span class='text'>{$lang->user->dynamic}</span>";
    $active = $methodName == 'dynamic' ? ' btn-active-text' : '';
    common::printLink('user', 'dynamic',  "type=today&account=$account", $label, '', "class='btn btn-link $active dynamicTab'");

    if($config->global->flow == 'full' or $config->global->flow == 'onlyTask')
    {
        $label  = "<span class='text'>{$lang->user->project}</span>";
        $active = $methodName == 'project' ? ' btn-active-text' : '';
        common::printLink('user', 'project',  "account=$account", $label, '', "class='btn btn-link $active projectTab'");
    }

    $label  = "<span class='text'>{$lang->user->profile}</span>";
    $active = $methodName == 'profile' ? ' btn-active-text' : '';
    common::printLink('user', 'profile',  "account=$account", $label, '', "class='btn btn-link $active profileTab'");
    ?>
  </div>
  <div class='actions'></div>
</div>
<script>
var type   = '<?php echo $type;?>';
var period = '<?php echo $period;?>';
</script>
<?php
$calendarHook = dirname(__FILE__) . '/featurebar.calendar.html.hook.php';
if(file_exists($calendarHook)) include $calendarHook;
?>
