<?php
$lang->deploy->common           = '上線計劃';
$lang->deploy->create           = '創建計劃';
$lang->deploy->view             = '計劃概況';
$lang->deploy->finish           = '完成';
$lang->deploy->edit             = '編輯';
$lang->deploy->delete           = '刪除';
$lang->deploy->activate         = '激活';
$lang->deploy->browse           = '瀏覽上線計劃';
$lang->deploy->scope            = '上線範圍';
$lang->deploy->manageScope      = '管理上線範圍';
$lang->deploy->cases            = '用例';
$lang->deploy->linkCases        = '關聯用例';
$lang->deploy->unlinkCase       = '移除用例';
$lang->deploy->steps            = '上線步驟';
$lang->deploy->manageStep       = '管理步驟';
$lang->deploy->finishStep       = '完成步驟';
$lang->deploy->activateStep     = '激活步驟';
$lang->deploy->assignTo         = '指派';
$lang->deploy->editStep         = '編輯步驟';
$lang->deploy->deleteStep       = '刪除步驟';
$lang->deploy->viewStep         = '步驟詳情';
$lang->deploy->batchUnlinkCases = '批量移除用例';

$lang->deploy->name       = '計劃名稱';
$lang->deploy->desc       = '描述';
$lang->deploy->members    = '上線人員';
$lang->deploy->hosts      = '主機';
$lang->deploy->service    = '服務';
$lang->deploy->product    = '產品';
$lang->deploy->release    = '發佈';
$lang->deploy->package    = '包地址';
$lang->deploy->begin      = '開始時間';
$lang->deploy->end        = '結束時間';
$lang->deploy->status     = '狀態';
$lang->deploy->owner      = '負責人';
$lang->deploy->stage      = '上線階段';
$lang->deploy->ditto      = '同上';
$lang->deploy->manageAB   = '管理';
$lang->deploy->title      = '步驟標題';
$lang->deploy->content    = '步驟描述';
$lang->deploy->assignedTo = '指派給';
$lang->deploy->finishedBy = '由誰完成';
$lang->deploy->createdBy  = '由誰創建';
$lang->deploy->result     = '結果';
$lang->deploy->updateHost = '修改主機關係';
$lang->deploy->removeHost = '待移除主機';
$lang->deploy->addHost    = '新加主機';
$lang->deploy->hadHost    = '已有主機';

$lang->deploy->lblBeginEnd = '起止時間';
$lang->deploy->lblBasic    = '基本信息';
$lang->deploy->lblProduct  = '關聯產品';
$lang->deploy->lblMonth    = '當前顯示';
$lang->deploy->toggle      = '切換';

$lang->deploy->monthFormat = 'Y年m月';

$lang->deploy->statusList['wait'] = '未完成';
$lang->deploy->statusList['done'] = '已完成';

$lang->deploy->dateList['today']     = '今天';
$lang->deploy->dateList['tomorrow']  = '明天';
$lang->deploy->dateList['thisweek']  = '本週';
$lang->deploy->dateList['thismonth'] = '本月';
$lang->deploy->dateList['done']      = $lang->deploy->statusList['done'];

$lang->deploy->stageList['wait']    = '上線前';
$lang->deploy->stageList['doing']   = '上線中';
$lang->deploy->stageList['testing'] = '冒煙測試';
$lang->deploy->stageList['done']    = '上線後';

$lang->deploy->resultList['']        = '';
$lang->deploy->resultList['success'] = '成功';
$lang->deploy->resultList['fail']    = '失敗';

$lang->deploy->confirmDelete     = '是否刪除該上線計劃';
$lang->deploy->confirmDeleteStep = '是否刪除該上線步驟';
$lang->deploy->errorTime         = '結束時間必須大於開始時間！';
$lang->deploy->errorStatusWait   = '如果步驟狀態是未完成，由誰完成必須為空';
$lang->deploy->errorStatusDone   = '如果步驟狀態是已完成，由誰完成不能為空';
$lang->deploy->errorOffline      = '服務的上架機器和下架機器不能共存。';
$lang->deploy->resultNotEmpty    = '結果不能為空';
