<div id='sidebarHeader'>
  <div class='title'><?php echo $deploy->name?></div>
</div>
<div class='btn-toolbar pull-left'>
  <?php
  $params     = "deployID=$deploy->id";
  $methodName = $app->getMethodName();
  common::printLink('deploy', 'steps',  $params, "<span class='text'>" . $lang->deploy->steps . '</span>', '', "id='stepsTab' class='btn btn-link" . ($methodName == 'steps' ? " btn-active-text" : '') . "'", '', '', $deploy);
  common::printLink('deploy', 'scope',  $params, "<span class='text'>" . $lang->deploy->scope . '</span>', '', "id='scopeTab' class='btn btn-link" . ($methodName == 'scope' ? " btn-active-text" : '') . "'", '', '', $deploy);
  common::printLink('deploy', 'cases',  $params, "<span class='text'>" . $lang->deploy->cases . '</span>', '', "id='casesTab' class='btn btn-link" . ($methodName == 'cases' ? " btn-active-text" : '') . "'", '', '', $deploy);
  common::printLink('deploy', 'view',   $params, "<span class='text'>" . $lang->deploy->view . '</span>',  '', "id='viewTab'  class='btn btn-link" . ($methodName == 'view'  ? " btn-active-text" : '') . "'", '', '', $deploy);
  ?>
</div>
