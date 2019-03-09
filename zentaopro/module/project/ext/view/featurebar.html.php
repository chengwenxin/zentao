<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php
    $active = $this->app->methodName == 'relation' ? 'btn-active-text' : '';
    echo html::a($this->createLink('project', 'relation', "projectID=$projectID"), "<span class='text'>" . $lang->project->gantt->relationOfTasks . "</span>", '', "class='btn btn-link $active'");
    $active = $this->app->methodName == 'maintainrelation' ? 'btn-active-text' : '';
    echo html::a($this->createLink('project', 'maintainRelation', "projectID=$projectID"), "<span class='text'>" . $lang->project->gantt->editRelationOfTasks . "</span>", '', "class='btn btn-link $active'");
    ?>
  </div>
  <div class="btn-toolbar pull-right">
    <?php
    if(!isset($browseType)) $browseType = '';
    if(!isset($orderBy))    $orderBy = '';
    $link = common::hasPriv('task', 'report', $project) ?  $this->createLink('task', 'report', "project=$projectID&browseType=$browseType") : '#';
    echo html::a($link, "<i class='icon icon-bar-chart muted'></i> <span class='text'>{$lang->task->reportChart}</span>", '', 'class="btn btn-link"');
    ?>
    <?php
    $checkObject = new stdclass();
    $checkObject->project = $projectID;
    $misc = common::hasPriv('task', 'create', $checkObject) ? "class='btn btn-primary'" : "class='btn btn-primary disabled'";
    $link = common::hasPriv('task', 'create', $checkObject) ?  $this->createLink('task', 'create', "project=$projectID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : '')) : '#';
    echo html::a($link, "<i class='icon icon-plus'></i>" . $lang->task->create, '', $misc);
    ?>
  </div>
</div>
