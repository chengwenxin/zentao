<?php
public function setListValue($productID)
{
    return $this->loadExtension('excel')->setListValue($productID);
}

public function createFromImport($productID)
{
    return $this->loadExtension('excel')->createFromImport($productID);
}
