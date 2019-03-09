<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php
  if(!isset($type))   $type   = 'today';
  if(!isset($period)) $period = 'today';
  $date = isset($date) ? $date : helper::today();

  echo  $userList;
  echo  html::a($this->createLink('user', 'todo',     "account=$account"), $lang->user->todo, '', "id='todoTab'");
  echo  html::a($this->createLink('user', 'effort',   "account=$account"), $lang->user->effort, '', "id='effortTab'");
  echo  html::a($this->createLink('user', 'story',    "account=$account"), $lang->user->story, '', "id='storyTab'");
  echo  html::a($this->createLink('user', 'task',     "account=$account"), $lang->user->task, '', "id='taskTab'"); 
  echo  html::a($this->createLink('user', 'bug',      "account=$account"), $lang->user->bug, '', "id='bugTab'");
  echo  html::a($this->createLink('user', 'testtask', "account=$account"), $lang->user->test, '', "id='testtaskTab'");
  echo  html::a($this->createLink('user', 'dynamic',  "type=today&account=$account"), $lang->user->dynamic, '', "id='dynamicTab'");
  echo  html::a($this->createLink('user', 'project',  "account=$account"), $lang->user->project, '', "id='projectTab'");
  echo  html::a($this->createLink('user', 'profile',  "account=$account"), $lang->user->profile, '', "id='profileTab'");
  ?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>
<script>
var type   = '<?php echo $type;?>';
var period = '<?php echo $period;?>';
</script>
