<?php
$lang->feedback->common      = '反馈';
$lang->feedback->index       = '反馈首页';
$lang->feedback->create      = '创建反馈';
$lang->feedback->edit        = '编辑反馈';
$lang->feedback->nonRDBrowse = '非研发界面浏览';
$lang->feedback->browse      = '浏览反馈';
$lang->feedback->list        = '反馈列表';
$lang->feedback->header      = '问题反馈';
$lang->feedback->view        = '反馈详情';
$lang->feedback->close       = '关闭';
$lang->feedback->feelLike    = '等感觉很赞！';
$lang->feedback->ask         = '追问';
$lang->feedback->toStory     = '转需求';
$lang->feedback->toBug       = '转Bug';
$lang->feedback->story       = '需求信息';
$lang->feedback->bug         = 'Bug信息';
$lang->feedback->reply       = '回复';
$lang->feedback->delete      = '删除反馈';
$lang->feedback->mailNotify  = '接收邮件通知。';
$lang->feedback->search      = '搜索';
$lang->feedback->comment     = '评论';
$lang->feedback->products    = '权限';
$lang->feedback->manageProduct = '关联' . $lang->productCommon;

$lang->feedback->product       = '所属产品';
$lang->feedback->title         = '标题';
$lang->feedback->desc          = '描述';
$lang->feedback->status        = '状态';
$lang->feedback->openedBy      = '反馈人';
$lang->feedback->openedDate    = '反馈时间';
$lang->feedback->processedBy   = '由谁处理';
$lang->feedback->processedDate = '处理时间';
$lang->feedback->closedBy      = '由谁关闭';
$lang->feedback->closedDate    = '关闭时间';
$lang->feedback->closedReason  = '关闭原因';
$lang->feedback->public        = '公开';
$lang->feedback->notify        = '通知';
$lang->feedback->files         = '附件';
$lang->feedback->labelBasic    = '基本信息';
$lang->feedback->dept          = '部门';

$lang->feedback->lblBasic   = '基本信息';
$lang->feedback->allProduct = '所有' . $lang->productCommon;

$lang->feedback->grantProduct   = '授权' . $lang->productCommon;
$lang->feedback->noGrantProduct = '无权' . $lang->productCommon;

$lang->feedback->tabList['unclosed'] = '待处理';
$lang->feedback->tabList['all']      = '全部';
$lang->feedback->tabList['public']   = '公开';

$lang->feedback->statusList['']           = '';
$lang->feedback->statusList['wait']       = '待处理';
$lang->feedback->statusList['commenting'] = '处理中';
$lang->feedback->statusList['replied']    = '已处理';
$lang->feedback->statusList['asked']      = '追问中';
$lang->feedback->statusList['tobug']      = '转Bug';
$lang->feedback->statusList['tostory']    = '转需求';
$lang->feedback->statusList['closed']     = '已关闭';

$lang->feedback->closedReasonList[]            = '';
$lang->feedback->closedReasonList['commented'] = '已处理';
$lang->feedback->closedReasonList['tobug']     = '转Bug';
$lang->feedback->closedReasonList['tostory']   = '转需求';
$lang->feedback->closedReasonList['repeat']    = '重复';
$lang->feedback->closedReasonList['refuse']    = '不予采纳';

$lang->feedback->publicList['']  = '';
$lang->feedback->publicList['0'] = '不公开';
$lang->feedback->publicList['1'] = '公开';

$lang->feedback->confirmDelete = '是否删除该反馈？';
$lang->feedback->confirmClose  = '是否关闭该反馈？';

$lang->feedback->commented = '$date, 由 <strong>$actor</strong> 添加评论。' . "\n";

$lang->feedback->action = new stdclass();
$lang->feedback->action->closed = array('main' => '$date, 由 <strong>$actor</strong> 关闭，原因为 <strong>$extra</strong>。', 'extra' => 'closedReasonList');   
