<?php
$lang->feedback->common      = '反饋';
$lang->feedback->index       = '反饋首頁';
$lang->feedback->create      = '創建反饋';
$lang->feedback->edit        = '編輯反饋';
$lang->feedback->nonRDBrowse = '非研發界面瀏覽';
$lang->feedback->browse      = '瀏覽反饋';
$lang->feedback->list        = '反饋列表';
$lang->feedback->header      = '問題反饋';
$lang->feedback->view        = '反饋詳情';
$lang->feedback->close       = '關閉';
$lang->feedback->feelLike    = '等感覺很贊！';
$lang->feedback->ask         = '追問';
$lang->feedback->toStory     = '轉需求';
$lang->feedback->toBug       = '轉Bug';
$lang->feedback->story       = '需求信息';
$lang->feedback->bug         = 'Bug信息';
$lang->feedback->reply       = '回覆';
$lang->feedback->delete      = '刪除反饋';
$lang->feedback->mailNotify  = '接收郵件通知。';
$lang->feedback->search      = '搜索';
$lang->feedback->comment     = '評論';
$lang->feedback->products    = '權限';
$lang->feedback->manageProduct = '關聯' . $lang->productCommon;

$lang->feedback->product       = '所屬產品';
$lang->feedback->title         = '標題';
$lang->feedback->desc          = '描述';
$lang->feedback->status        = '狀態';
$lang->feedback->openedBy      = '反饋人';
$lang->feedback->openedDate    = '反饋時間';
$lang->feedback->processedBy   = '由誰處理';
$lang->feedback->processedDate = '處理時間';
$lang->feedback->closedBy      = '由誰關閉';
$lang->feedback->closedDate    = '關閉時間';
$lang->feedback->closedReason  = '關閉原因';
$lang->feedback->public        = '公開';
$lang->feedback->notify        = '通知';
$lang->feedback->files         = '附件';
$lang->feedback->labelBasic    = '基本信息';
$lang->feedback->dept          = '部門';

$lang->feedback->lblBasic   = '基本信息';
$lang->feedback->allProduct = '所有' . $lang->productCommon;

$lang->feedback->grantProduct   = '授權' . $lang->productCommon;
$lang->feedback->noGrantProduct = '無權' . $lang->productCommon;

$lang->feedback->tabList['unclosed'] = '待處理';
$lang->feedback->tabList['all']      = '全部';
$lang->feedback->tabList['public']   = '公開';

$lang->feedback->statusList['']           = '';
$lang->feedback->statusList['wait']       = '待處理';
$lang->feedback->statusList['commenting'] = '處理中';
$lang->feedback->statusList['replied']    = '已處理';
$lang->feedback->statusList['asked']      = '追問中';
$lang->feedback->statusList['tobug']      = '轉Bug';
$lang->feedback->statusList['tostory']    = '轉需求';
$lang->feedback->statusList['closed']     = '已關閉';

$lang->feedback->closedReasonList[]            = '';
$lang->feedback->closedReasonList['commented'] = '已處理';
$lang->feedback->closedReasonList['tobug']     = '轉Bug';
$lang->feedback->closedReasonList['tostory']   = '轉需求';
$lang->feedback->closedReasonList['repeat']    = '重複';
$lang->feedback->closedReasonList['refuse']    = '不予採納';

$lang->feedback->publicList['']  = '';
$lang->feedback->publicList['0'] = '不公開';
$lang->feedback->publicList['1'] = '公開';

$lang->feedback->confirmDelete = '是否刪除該反饋？';
$lang->feedback->confirmClose  = '是否關閉該反饋？';

$lang->feedback->commented = '$date, 由 <strong>$actor</strong> 添加評論。' . "\n";

$lang->feedback->action = new stdclass();
$lang->feedback->action->closed = array('main' => '$date, 由 <strong>$actor</strong> 關閉，原因為 <strong>$extra</strong>。', 'extra' => 'closedReasonList');   
