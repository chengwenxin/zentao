<?php
public function getList()
{
    return $this->loadExtension('zentaobiz')->getList();
}

public function create()
{
    return $this->loadExtension('zentaobiz')->create();
}

public function getPairs()
{
    return $this->loadExtension('zentaobiz')->getPairs();
}
