<?php
$lang->deploy->common           = '上线计划';
$lang->deploy->create           = '创建计划';
$lang->deploy->view             = '计划概况';
$lang->deploy->finish           = '完成';
$lang->deploy->edit             = '编辑';
$lang->deploy->delete           = '删除';
$lang->deploy->activate         = '激活';
$lang->deploy->browse           = '浏览上线计划';
$lang->deploy->scope            = '上线范围';
$lang->deploy->manageScope      = '管理上线范围';
$lang->deploy->cases            = '用例';
$lang->deploy->linkCases        = '关联用例';
$lang->deploy->unlinkCase       = '移除用例';
$lang->deploy->steps            = '上线步骤';
$lang->deploy->manageStep       = '管理步骤';
$lang->deploy->finishStep       = '完成步骤';
$lang->deploy->activateStep     = '激活步骤';
$lang->deploy->assignTo         = '指派';
$lang->deploy->editStep         = '编辑步骤';
$lang->deploy->deleteStep       = '删除步骤';
$lang->deploy->viewStep         = '步骤详情';
$lang->deploy->batchUnlinkCases = '批量移除用例';

$lang->deploy->name       = '计划名称';
$lang->deploy->desc       = '描述';
$lang->deploy->members    = '上线人员';
$lang->deploy->hosts      = '主机';
$lang->deploy->service    = '服务';
$lang->deploy->product    = '产品';
$lang->deploy->release    = '发布';
$lang->deploy->package    = '包地址';
$lang->deploy->begin      = '开始时间';
$lang->deploy->end        = '结束时间';
$lang->deploy->status     = '状态';
$lang->deploy->owner      = '负责人';
$lang->deploy->stage      = '上线阶段';
$lang->deploy->ditto      = '同上';
$lang->deploy->manageAB   = '管理';
$lang->deploy->title      = '步骤标题';
$lang->deploy->content    = '步骤描述';
$lang->deploy->assignedTo = '指派给';
$lang->deploy->finishedBy = '由谁完成';
$lang->deploy->createdBy  = '由谁创建';
$lang->deploy->result     = '结果';
$lang->deploy->updateHost = '修改主机关系';
$lang->deploy->removeHost = '待移除主机';
$lang->deploy->addHost    = '新加主机';
$lang->deploy->hadHost    = '已有主机';

$lang->deploy->lblBeginEnd = '起止时间';
$lang->deploy->lblBasic    = '基本信息';
$lang->deploy->lblProduct  = '关联产品';
$lang->deploy->lblMonth    = '当前显示';
$lang->deploy->toggle      = '切换';

$lang->deploy->monthFormat = 'Y年m月';

$lang->deploy->statusList['wait'] = '未完成';
$lang->deploy->statusList['done'] = '已完成';

$lang->deploy->dateList['today']     = '今天';
$lang->deploy->dateList['tomorrow']  = '明天';
$lang->deploy->dateList['thisweek']  = '本周';
$lang->deploy->dateList['thismonth'] = '本月';
$lang->deploy->dateList['done']      = $lang->deploy->statusList['done'];

$lang->deploy->stageList['wait']    = '上线前';
$lang->deploy->stageList['doing']   = '上线中';
$lang->deploy->stageList['testing'] = '冒烟测试';
$lang->deploy->stageList['done']    = '上线后';

$lang->deploy->resultList['']        = '';
$lang->deploy->resultList['success'] = '成功';
$lang->deploy->resultList['fail']    = '失败';

$lang->deploy->confirmDelete     = '是否删除该上线计划';
$lang->deploy->confirmDeleteStep = '是否删除该上线步骤';
$lang->deploy->errorTime         = '结束时间必须大于开始时间！';
$lang->deploy->errorStatusWait   = '如果步骤状态是未完成，由谁完成必须为空';
$lang->deploy->errorStatusDone   = '如果步骤状态是已完成，由谁完成不能为空';
$lang->deploy->errorOffline      = '服务的上架机器和下架机器不能共存。';
$lang->deploy->resultNotEmpty    = '结果不能为空';
