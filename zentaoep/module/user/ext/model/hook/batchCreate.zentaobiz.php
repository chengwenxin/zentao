<?php
$feedbackUserLimit = $this->getBizUserLimit('feedback');
if($feedbackUserLimit)
{
    $feedbackUser = $this->dao->select("COUNT('*') as count")->from(TABLE_USER)
        ->where('deleted')->eq(0)
        ->andWhere('feedback')->eq(1)
        ->fetch();
    $feedbackMaxUsers = $feedbackUser->count >= $feedbackUserLimit;
}

foreach($this->post->account as $i => $account)
{
    if(empty($account)) continue;

    if($feedbackUserLimit and $this->post->feedback[$i] == 1)
    {
        if(!$feedbackMaxUsers)
        {
            $feedbackUser->count++;
            if($feedbackUser->count >= $feedbackUserLimit) $feedbackMaxUsers = true;
        }
        else
        {
            $_POST['account'][$i] = '';
        }
    }
}
