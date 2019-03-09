<?php
if(isset($this->config->bizVersion))
{
    $proUserLimit = $this->getProUserLimit();
    if($proUserLimit)
    {
        $user = $this->dao->select("COUNT('*') as count")->from(TABLE_USER)
            ->where('deleted')->eq(0)
            ->andWhere('feedback')->eq('0')
            ->fetch();
        $maxUsers = $user->count >= $proUserLimit;

        foreach($this->post->account as $i => $account)
        {
            if(!empty($this->post->feedback[$i])) continue;
            if(empty($account)) continue;
            if(!$maxUsers)
            {
                $user->count++;
                if($user->count >= $proUserLimit) $maxUsers = true;
            }
            else
            {
                $_POST['account'][$i] = '';
            }
        }
    }
}
