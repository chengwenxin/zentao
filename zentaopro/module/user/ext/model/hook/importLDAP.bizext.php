<?php
if(isset($this->config->bizVersion))
{
    $userLimit = $this->getProUserLimit();
    if($userLimit)
    {
        $user = $this->dao->select("COUNT('*') as count")->from(TABLE_USER)
            ->where('deleted')->eq(0)
            ->andWhere('feedback')->eq(0)
            ->fetch();
        $maxUsers = $user->count >= $userLimit;

        foreach($this->post->add as $i => $add)
        {
            if(!$maxUsers)
            {
                $user->count++;
                if($user->count >= $userLimit) $maxUsers = true;
            }
            else
            {
                unset($_POST['add'][$i]);
            }
        }
    }
}
