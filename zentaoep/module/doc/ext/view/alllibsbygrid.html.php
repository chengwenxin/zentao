<div class="main-col" data-min-width="400">
  <div class="panel block-files block-sm no-margin">
    <div class="panel-heading">
      <div class="panel-title font-normal">
        <?php $panelTitle = zget($lang->doclib->tabList, $type);?>
        <i class="icon icon-folder-open-o text-muted"></i> <?php echo $panelTitle;?>
        <div class="btn-group">
          <?php echo html::a('javascript:setBrowseType("bylist")', "<i class='icon icon-bars'></i>", '', "title='{$lang->doc->browseTypeList['list']}' class='btn btn-icon'");?>
          <?php echo html::a('javascript:setBrowseType("bygrid")', "<i class='icon icon-cards-view'></i>", '', "title='{$lang->doc->browseTypeList['grid']}' class='btn btn-icon text-primary'");?>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="row row-grid files-grid" data-size="300">
        <?php $icon = 'icon-folder text-yellow';?>
        <?php foreach($libs as $lib):?>
        <div class="col">
          <?php $link = $this->createLink('doc', 'browse', "libID=$lib->id");?>
          <a class="file" href="<?php echo $link;?>">
            <i class="file-icon icon <?php echo $icon;?>"></i>
            <div class="file-name"><?php echo (strpos($lib->collector, $this->app->user->account) !== false ? "<i class='icon icon-star text-yellow'></i> " : '') . $lib->name;?></div>
          </a>
          <div class="actions">
            <?php $star = strpos($lib->collector, ',' . $this->app->user->account . ',') !== false ? 'icon-star text-yellow' : 'icon-star-empty';?>
            <?php $collectTitle = strpos($lib->collector, ',' . $this->app->user->account . ',') !== false ? $lang->doc->cancelCollection : $lang->doc->collect;?>
            <a data-url="<?php echo $this->createLink('doc', 'collect', "objectID=$lib->id&objectType=doclib");?>" title="<?php echo $collectTitle;?>" class='btn btn-link ajaxCollect'><i class='icon <?php echo $star;?>'></i></a>
            <?php common::printLink('doc', 'editLib', "libID=$lib->id", "<i class='icon icon-edit'></i>", '', "title='{$lang->edit}' class='btn btn-link iframe'")?>
            <?php common::printLink('doc', 'deleteLib', "libID=$lib->id", "<i class='icon icon-close'></i>", 'hiddenwin', "title='{$lang->delete}' class='btn btn-link'")?>
            <?php common::printLink('doc', 'manageBook', "bookID=$lib->id&nodeID=0", "<i class='icon icon-cog'></i>", '', "title='{$lang->doc->manageBook}' class='btn btn-link'")?>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <div class='table-footer'><?php $pager->show('right', 'pagerjs');?></div>
    </div>
  </div>
</div>
