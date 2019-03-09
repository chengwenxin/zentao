<?php
public function getDeptPairs($params = '', $dept = '')
{
    return $this->loadExtension('oa')->getDeptPairs($params, $dept);
}

public function getByAccount($account)
{
    return $this->loadExtension('oa')->getByAccount($account);
}

public function getUserManagerPairs()
{
    return $this->loadExtension('oa')->getUserManagerPairs();
}
