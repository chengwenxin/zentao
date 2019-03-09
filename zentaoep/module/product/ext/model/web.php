<?php
public function setMenu($products, $productID, $branch = 0, $module = 0, $moduleType = '', $extra = '')
{
    return $this->loadExtension('web')->setMenu($products, $productID, $branch, $module, $moduleType, $extra);
}
