<?php
if(!isset($lang->lieu)) $lang->lieu = new stdclass();
$lang->lieu->common = '調休';
$lang->lieu->browse = '調休列表';
$lang->lieu->create = '申請調休';
$lang->lieu->edit   = '編輯';
$lang->lieu->view   = '詳情';
$lang->lieu->delete = '刪除';
$lang->lieu->review = '審核';
$lang->lieu->cancel = '撤銷';
$lang->lieu->commit = '提交';

$lang->lieu->personal     = '我的調休';
$lang->lieu->browseReview = '審核列表';
$lang->lieu->company      = '所有調休';
$lang->lieu->setReviewer  = '調休設置';
$lang->lieu->batchReview  = '批量審核';
$lang->lieu->batchPass    = '批量通過';

$lang->lieu->id           = '編號';
$lang->lieu->year         = '年';
$lang->lieu->begin        = '開始';
$lang->lieu->end          = '結束';
$lang->lieu->start        = '開始時間';
$lang->lieu->finish       = '結束時間';
$lang->lieu->hours        = '總時長';
$lang->lieu->overtime     = '加班記錄';
$lang->lieu->trip         = '出差記錄';
$lang->lieu->status       = '狀態';
$lang->lieu->desc         = '事由';
$lang->lieu->createdBy    = '申請者';
$lang->lieu->createdDate  = '申請時間';
$lang->lieu->reviewedBy   = '審核者';
$lang->lieu->reviewedDate = '審核時間';
$lang->lieu->date         = '日期';
$lang->lieu->time         = '時間';
$lang->lieu->rejectReason = '拒絶原因';

$lang->lieu->statusList['draft']  = '草稿';
$lang->lieu->statusList['wait']   = '等待審核';
$lang->lieu->statusList['doing']  = '審核中';
$lang->lieu->statusList['pass']   = '通過';
$lang->lieu->statusList['reject'] = '拒絶';

$lang->lieu->confirmReview['pass']   = '您確定要執行通過操作嗎？';
$lang->lieu->confirmReview['reject'] = '您確定要執行拒絶操作嗎？';

$lang->lieu->notExist      = '記錄不存在';
$lang->lieu->checkHours    = '調休時長檢測';
$lang->lieu->denied        = '信息訪問受限';
$lang->lieu->unique        = '%s 已經存在調休記錄';
$lang->lieu->sameMonth     = '不支持跨月份調休';
$lang->lieu->wrongEnd      = '結束時間應該大於開始時間';
$lang->lieu->nodata        = '沒有選擇數據';
$lang->lieu->reviewSuccess = '審核成功';
$lang->lieu->wrongHours    = '加班和出差總時長 <strong>%s</strong> 小時，調休時長不能超過總時長。';
$lang->lieu->nobccomp      = '請安裝bcmath擴展';
$lang->lieu->bothEmpty     = '<strong>加班記錄</strong>和<strong>出差記錄</strong>不能同時為空';

$lang->lieu->hoursTip = '小時';

$lang->lieu->checkHoursList['0'] = '不檢測調休時長';
$lang->lieu->checkHoursList['1'] = '調休時長不能超過加班時長';

$lang->lieu->reviewStatusList['pass']   = '通過';
$lang->lieu->reviewStatusList['reject'] = '拒絶';
