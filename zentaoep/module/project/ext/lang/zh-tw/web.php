<?php
$lang->project->webMenu = new stdclass();
$lang->project->webMenu->task     = array('link' => "任務|project|task|projectID=%s", 'subModule' => 'task', 'alias' => 'importtask,importbug,tree');
$lang->project->webMenu->story    = "需求|project|story|projectID=%s";
$lang->project->webMenu->bug      = "Bug|project|bug|projectID=%s";
$lang->project->webMenu->build    = array('link' => "版本|project|build|projectID=%s", 'subModule' => 'build');
$lang->project->webMenu->testtask = "測試單|project|testtask|projectID=%s";
$lang->project->webMenu->team     = "團隊|project|team|projectID=%s";
$lang->project->webMenu->action   = "動態|project|dynamic|projectID=%s";
$lang->project->webMenu->view     = "概況|project|view|projectID=%s";
$lang->project->webMenu->all      = "所有項目|project|all|";

$lang->project->webMenuOrder[5]  = "task";
$lang->project->webMenuOrder[10] = "story";
$lang->project->webMenuOrder[15] = "bug";
$lang->project->webMenuOrder[20] = "build";
$lang->project->webMenuOrder[25] = "testtask";
$lang->project->webMenuOrder[30] = "team";
$lang->project->webMenuOrder[35] = "action";
$lang->project->webMenuOrder[40] = "view";
$lang->project->webMenuOrder[45] = "all";
