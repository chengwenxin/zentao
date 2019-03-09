<?php
public function bind()
{
    return $this->loadExtension('bizext')->bind();
}

public function createUser()
{
    return $this->loadExtension('bizext')->createUser();
}
