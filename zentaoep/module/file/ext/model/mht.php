<?php
public function getMhtDocument($content , $absolutePath = "", $isEraseLink = false)
{
    return $this->loadExtension('mht')->getMhtDocument($content, $absolutePath, $isEraseLink);
}
