<?php
$lang->project->editrelation     = '維護任務關係';
$lang->project->maintainRelation = '維護任務關係';
$lang->project->deleterelation   = '刪除任務關係';
$lang->project->viewrelation     = '查看任務關係';
$lang->project->ganttchart       = '甘特圖';

$lang->project->gantt            = new stdclass();
$lang->project->gantt->common    = '甘特圖';
$lang->project->gantt->id        = '編號';
$lang->project->gantt->pretask   = '條件任務';
$lang->project->gantt->condition = '條件動作';
$lang->project->gantt->task      = '任務';
$lang->project->gantt->action    = '動作';
$lang->project->gantt->type      = '關係類型';

$lang->project->gantt->createRelationOfTasks    = '創建任務關係';
$lang->project->gantt->newCreateRelationOfTasks = '新增任務關係';
$lang->project->gantt->editRelationOfTasks      = '維護任務關係';
$lang->project->gantt->relationOfTasks          = '查看任務關係';

$lang->project->gantt->assignTo  = '指派給';
$lang->project->gantt->duration  = '時長';
$lang->project->gantt->comp      = '進度';
$lang->project->gantt->startDate = '開始日期';
$lang->project->gantt->endDate   = '結束日期';
$lang->project->gantt->days      = ' 天';
$lang->project->gantt->format    = '查看格式';
$lang->project->gantt->day       = '天';
$lang->project->gantt->week      = '周';
$lang->project->gantt->month     = '月';
$lang->project->gantt->quarter   = '季度';

$lang->project->gantt->preTaskStatus['']      = '';
$lang->project->gantt->preTaskStatus['begin'] = '開始後';
$lang->project->gantt->preTaskStatus['end']   = '完成後';

$lang->project->gantt->taskActions[''] = '';
$lang->project->gantt->taskActions['begin'] = '才能開始';
$lang->project->gantt->taskActions['end']   = '才能完成';

$lang->project->gantt->color[0] = 'fff000';
$lang->project->gantt->color[1] = 'ff0000';
$lang->project->gantt->color[2] = 'ff00ff';
$lang->project->gantt->color[3] = '0000ff';
$lang->project->gantt->color[4] = '00ff00';

$lang->project->gantt->browseType['type']       = '按任務類型分組';
$lang->project->gantt->browseType['module']     = '按模組分組';
$lang->project->gantt->browseType['assignedTo'] = '按指派給分組';
$lang->project->gantt->browseType['story']      = '按需求分組';

$lang->project->gantt->confirmDelete = '確認要刪除此任務關係嗎？';
$lang->project->gantt->tmpNotWrite   = '不可寫';

$lang->project->gantt->warning                 = new stdclass();
$lang->project->gantt->warning->noEditSame     = "已有的編號%s前後任務不能相同！";
$lang->project->gantt->warning->noEditRepeat   = "已有的編號%s與已有的編號%s任務關係之間重複！";
$lang->project->gantt->warning->noEditContrary = "已有的編號%s與已有的編號%s任務關係之間有矛盾！";
$lang->project->gantt->warning->noRepeat       = "已有的編號%s與新增的編號%s任務關係之間重複！";
$lang->project->gantt->warning->noContrary     = "已有的編號%s與新增的編號%s任務關係之間有矛盾！";
$lang->project->gantt->warning->noNewSame      = "新增的編號%s前後任務不能相同！";
$lang->project->gantt->warning->noNewRepeat    = "新增的編號%s與新增的編號%s任務關係之間重複！";
$lang->project->gantt->warning->noNewContrary  = "新增的編號%s與新增的編號%s任務關係之間有矛盾！";
