<?php
public function checkBizUserLimit($type = 'user')
{
    return $this->loadExtension('zentaobiz')->checkBizUserLimit($type);
}

public function getBizUserLimit($type = 'user')
{
    return $this->loadExtension('zentaobiz')->getBizUserLimit($type);
}

public function getPairs($params = '', $usersToAppended = '')
{
    return $this->loadExtension('zentaobiz')->getPairs($params, $usersToAppended);
}

public function getByQuery($query, $pager = null, $orderBy = 'id')
{
    return $this->loadExtension('zentaobiz')->getByQuery($query, $pager, $orderBy);
}
