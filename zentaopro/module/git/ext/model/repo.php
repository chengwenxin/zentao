<?php
public function getRepos()
{
    return $this->loadExtension('repo')->getRepos();
}
