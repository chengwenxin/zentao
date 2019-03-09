<?php
$lang->feedback->common      = 'Feedback';
$lang->feedback->index       = 'Feedback Home';
$lang->feedback->create      = 'Add Feedback';
$lang->feedback->edit        = 'Edit';
$lang->feedback->nonRDBrowse = 'Non-Developer interface';
$lang->feedback->browse      = 'View';
$lang->feedback->list        = 'Feedback list';
$lang->feedback->header      = 'Feedback';
$lang->feedback->view        = 'Details';
$lang->feedback->close       = 'Close';
$lang->feedback->feelLike    = 'Like';
$lang->feedback->ask         = 'Ask';
$lang->feedback->toStory     = 'To Story';
$lang->feedback->toBug       = 'To Bug';
$lang->feedback->story       = 'Story';
$lang->feedback->bug         = 'Bug';
$lang->feedback->reply       = 'Reply';
$lang->feedback->delete      = 'Delete';
$lang->feedback->mailNotify  = 'Email';
$lang->feedback->search      = 'Search';
$lang->feedback->comment     = 'Comment';
$lang->feedback->products    = 'Permission';
$lang->feedback->manageProduct = 'Link ' . $lang->productCommon;

$lang->feedback->product       = 'Product';
$lang->feedback->title         = 'Title';
$lang->feedback->desc          = 'Description';
$lang->feedback->status        = 'Status';
$lang->feedback->openedBy      = 'Added by';
$lang->feedback->openedDate    = 'Added on';
$lang->feedback->processedBy   = 'Replied by';
$lang->feedback->processedDate = 'Replied on';
$lang->feedback->closedBy      = 'Closed by';
$lang->feedback->closedDate    = 'Closed on';
$lang->feedback->closedReason  = 'Close Reason';
$lang->feedback->public        = 'Public';
$lang->feedback->notify        = 'Notification';
$lang->feedback->files         = 'Files';
$lang->feedback->labelBasic    = 'Basic';
$lang->feedback->dept          = 'Dept';

$lang->feedback->lblBasic   = 'Basic information';
$lang->feedback->allProduct = 'All ' . $lang->productCommon;

$lang->feedback->grantProduct   = 'Link ' . $lang->productCommon;
$lang->feedback->noGrantProduct = 'Unlink ' . $lang->productCommon;

$lang->feedback->tabList['unclosed'] = 'Wait';
$lang->feedback->tabList['all']      = 'All';
$lang->feedback->tabList['public']   = 'Public';

$lang->feedback->statusList['']           = '';
$lang->feedback->statusList['wait']       = 'Wait';
$lang->feedback->statusList['commenting'] = 'Doing';
$lang->feedback->statusList['replied']    = 'Replied';
$lang->feedback->statusList['asked']      = 'Doubted';
$lang->feedback->statusList['tobug']      = 'To Bug';
$lang->feedback->statusList['tostory']    = 'To Story';
$lang->feedback->statusList['closed']     = 'Closed';

$lang->feedback->closedReasonList[]            = '';
$lang->feedback->closedReasonList['commented'] = 'Replied';
$lang->feedback->closedReasonList['tobug']     = 'To bug';
$lang->feedback->closedReasonList['tostory']   = 'To story';
$lang->feedback->closedReasonList['repeat']    = 'Repeat';
$lang->feedback->closedReasonList['refuse']    = 'Reject';

$lang->feedback->publicList['']  = '';
$lang->feedback->publicList['0'] = 'Private';
$lang->feedback->publicList['1'] = 'Public';

$lang->feedback->confirmDelete = 'Do you want to delete this feedback?';
$lang->feedback->confirmClose  = 'Do you want to close this feedback?';

$lang->feedback->commented = '$date, replied by <strong>$actor</strong>.' . "\n";

$lang->feedback->action = new stdclass();
$lang->feedback->action->closed = array('main' => '$date, closed by <strong>$actor</strong>. Close Reason is <strong>$extra</strong>.', 'extra' => 'closedReasonList');   
