<?php
$lang->project->editrelation     = '维护任务关系';
$lang->project->maintainRelation = '维护任务关系';
$lang->project->deleterelation   = '删除任务关系';
$lang->project->viewrelation     = '查看任务关系';
$lang->project->ganttchart       = '甘特图';

$lang->project->gantt            = new stdclass();
$lang->project->gantt->common    = '甘特图';
$lang->project->gantt->id        = '编号';
$lang->project->gantt->pretask   = '条件任务';
$lang->project->gantt->condition = '条件动作';
$lang->project->gantt->task      = '任务';
$lang->project->gantt->action    = '动作';
$lang->project->gantt->type      = '关系类型';

$lang->project->gantt->createRelationOfTasks    = '创建任务关系';
$lang->project->gantt->newCreateRelationOfTasks = '新增任务关系';
$lang->project->gantt->editRelationOfTasks      = '维护任务关系';
$lang->project->gantt->relationOfTasks          = '查看任务关系';

$lang->project->gantt->assignTo  = '指派给';
$lang->project->gantt->duration  = '时长';
$lang->project->gantt->comp      = '进度';
$lang->project->gantt->startDate = '开始日期';
$lang->project->gantt->endDate   = '结束日期';
$lang->project->gantt->days      = ' 天';
$lang->project->gantt->format    = '查看格式';
$lang->project->gantt->day       = '天';
$lang->project->gantt->week      = '周';
$lang->project->gantt->month     = '月';
$lang->project->gantt->quarter   = '季度';

$lang->project->gantt->preTaskStatus['']      = '';
$lang->project->gantt->preTaskStatus['begin'] = '开始后';
$lang->project->gantt->preTaskStatus['end']   = '完成后';

$lang->project->gantt->taskActions[''] = '';
$lang->project->gantt->taskActions['begin'] = '才能开始';
$lang->project->gantt->taskActions['end']   = '才能完成';

$lang->project->gantt->color[0] = 'fff000';
$lang->project->gantt->color[1] = 'ff0000';
$lang->project->gantt->color[2] = 'ff00ff';
$lang->project->gantt->color[3] = '0000ff';
$lang->project->gantt->color[4] = '00ff00';

$lang->project->gantt->browseType['type']       = '按任务类型分组';
$lang->project->gantt->browseType['module']     = '按模块分组';
$lang->project->gantt->browseType['assignedTo'] = '按指派给分组';
$lang->project->gantt->browseType['story']      = '按需求分组';

$lang->project->gantt->confirmDelete = '确认要删除此任务关系吗？';
$lang->project->gantt->tmpNotWrite   = '不可写';

$lang->project->gantt->warning                 = new stdclass();
$lang->project->gantt->warning->noEditSame     = "已有的编号%s前后任务不能相同！";
$lang->project->gantt->warning->noEditRepeat   = "已有的编号%s与已有的编号%s任务关系之间重复！";
$lang->project->gantt->warning->noEditContrary = "已有的编号%s与已有的编号%s任务关系之间有矛盾！";
$lang->project->gantt->warning->noRepeat       = "已有的编号%s与新增的编号%s任务关系之间重复！";
$lang->project->gantt->warning->noContrary     = "已有的编号%s与新增的编号%s任务关系之间有矛盾！";
$lang->project->gantt->warning->noNewSame      = "新增的编号%s前后任务不能相同！";
$lang->project->gantt->warning->noNewRepeat    = "新增的编号%s与新增的编号%s任务关系之间重复！";
$lang->project->gantt->warning->noNewContrary  = "新增的编号%s与新增的编号%s任务关系之间有矛盾！";
