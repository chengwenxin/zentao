<?php
public function getList($keywords, $pager, $type)
{
    return $this->loadExtension('search')->getList($keywords, $pager, $type);
}

/**
 * Save an index item.
 * 
 * @param  string    $objectType article|blog|page|product|thread|reply|
 * @param  int       $objectID 
 * @access public
 * @return void
 */
public function saveIndex($objectType, $object)
{
    return $this->loadExtension('search')->saveIndex($objectType, $object);
}

/**
 * Save dict info. 
 * 
 * @param  array    $words 
 * @access public
 * @return void
 */
public function saveDict($dict)
{
    return $this->loadExtension('search')->saveDict($dict);
}

public function buildIndexQuery($type, $testDeleted = true)
{
    return $this->loadExtension('search')->buildIndexQuery($type, $testDeleted);
}

/**
 * Build all search index.
 * 
 * @access public
 * @return bool
 */
public function buildAllIndex($type = '', $lastID = 0)
{
    return $this->loadExtension('search')->buildAllIndex($type, $lastID);
}

/**
 * Delete index of an object.
 * 
 * @param  string    $objectType 
 * @param  int       $objectID 
 * @access public
 * @return void
 */
public function deleteIndex($objectType, $objectID)
{
    return $this->loadExtension('search')->deleteIndex($objectType, $objectID);
}
