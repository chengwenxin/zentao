<style>
#book .tree li.active>span.item{font-weight: 700; color: #0c64eb;}
#book .tree li.active>span.item a{font-weight: 700; color: #0c64eb;}
#book .tree li>span.item a{color: #0d3d88;}
</style>
<?php $activeClass = (strpos(",browse,managebook,catalog,edit", ",{$this->methodName},") !== 'false' && isset($currentLib->id) && $currentLib->id == $sideLibID) ? 'active' : '';?>
<li <?php echo "class='$activeClass'";?>>
  <?php echo html::a($this->createLink('doc', 'browse', "libID=$sideLibID"), "<i class='icon icon-folder-o'></i> " . $sideLibName, '', "class='text-ellipsis' title='{$sideLibName}'");?>
  <?php $serials  = $this->doc->computeSN($sideLibID); ?>
  <?php $nodeList = $this->doc->getBookStructure($sideLibID);?>
  <ul>
    <?php foreach($nodeList as $nodeInfo):?>
    <?php $serial = $nodeInfo->type != 'book' ? $serials[$nodeInfo->id] : '';?>
    <?php if($nodeInfo->parent != 0) continue;?>
    <?php $activeClass = (isset($doc->id) && $doc->id == $nodeInfo->id) ? 'active' : '';?>
      <li <?php echo "class='open $activeClass'";?>>
      <?php if($nodeInfo->type == 'chapter'):?>
      <?php echo "<span class='item'>{$serial} {$nodeInfo->title}</span>";?>
      <?php elseif($nodeInfo->type == 'article'):?>
      <?php echo "<span class='item'>{$serial} " . html::a(helper::createLink('doc', 'view', "docID=$nodeInfo->id"), $nodeInfo->title, '') . '</span>';?>
      <?php endif;?>
      <?php if(!empty($nodeInfo->children)) $this->doc->getFrontCatalog($nodeInfo->children, $serials, isset($doc->id) ? $doc->id : 0);?>
      </li> 
    <?php endforeach;?>
  </ul>
</li>
