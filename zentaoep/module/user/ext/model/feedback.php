<?php
public function authorize($account)
{
    return $this->loadExtension('feedback')->authorize($account);
}

public function getFeedbacks($pager = null)
{
    return $this->loadExtension('feedback')->getFeedbacks($pager);
}
