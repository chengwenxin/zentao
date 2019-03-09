<?php
public function getPairsByProduct($productID, $branch = 0)
{
    return $this->loadExtension('ops')->getPairsByProduct($productID, $branch);
}
