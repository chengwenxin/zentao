<?php
public function getPairs($categories = '', $type = 'dept')
{
    return $this->loadExtension('oa')->getPairs($categories, $type);
}

public function getDeptManagedByMe($account)
{
    return $this->loadExtension('oa')->getDeptManagedByMe($account);
}

public function getListByType($type = 'dept', $orderBy = 'id_asc')
{
    return $this->loadExtension('oa')->getListByType($type, $orderBy);
}
