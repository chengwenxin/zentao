<?php
/* Task */
public function getFullTask($range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getFullTask($range, $last, $records);
}

public function getIncrementTask($range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getIncrementTask($range, $last, $records);
}

/* Story */
public function getFullStory($range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getFullStory($range, $last, $records);
}

public function getIncrementStory($range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getIncrementStory($range, $last, $records);
}

/* Bug */
public function getFullBug($range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getFullBug($range, $last, $records);
}

public function getIncrementBug($range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getIncrementBug($range, $last, $records);
}

/* Todo */
public function getFullTodo($account, $range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getFullTodo($account, $range, $last, $records);
}

public function getIncrementTodo($account, $range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getIncrementTodo($account, $range, $last, $records);
}

/* Product */
public function getFullProduct($account, $range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getFullProduct($account, $range, $last, $records);
}

public function getIncrementProduct($account, $range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getIncrementProduct($account, $range, $last, $records);
}

/* Project */
public function getFullProject($account, $range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getFullProject($account, $range, $last, $records);
}

public function getIncrementProject($account, $range = 0, $last = '', $records = 1000)
{
    return $this->loadExtension('clientapi')->getIncrementProject($account, $range, $last, $records);
}

/* Helpers */
public function format($type, $project, $format = 'all')
{
    return $this->loadExtension('clientapi')->format($type, $project, $format);
}

public function formatDateTime($datetimeStr)
{
    return $this->loadExtension('clientapi')->formatDateTime($datetimeStr);
}


public function process($type, $items, $last = '', $format = 'index')
{
    return $this->loadExtension('clientapi')->process($type, $items, $last, $format);
}

public function getDataByID($id, $type)
{
    return $this->loadExtension('clientapi')->getDataByID($id, $type);
}

public function getHistoryByID($id, $type)
{
    return $this->loadExtension('clientapi')->getHistoryByID($id, $type);
}

public function compression($data)
{
    return $this->loadExtension('clientapi')->compression($data);
}
