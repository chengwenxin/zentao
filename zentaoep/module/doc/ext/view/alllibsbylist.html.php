<div class="main-col" data-min-width="400">
  <div class="panel block-files block-sm no-margin">
    <div class="panel-heading">
      <div class="panel-title font-normal">
        <?php $panelTitle = zget($lang->doclib->tabList, $type);?>
        <i class="icon icon-folder-open-o text-muted"></i> <?php echo $panelTitle;?>
        <div class="btn-group">
          <?php echo html::a('javascript:setBrowseType("bylist")', "<i class='icon icon-bars'></i>", '', "title='{$lang->doc->browseTypeList['list']}' class='btn btn-icon text-primary'");?>
          <?php echo html::a('javascript:setBrowseType("bygrid")', "<i class='icon icon-cards-view'></i>", '', "title='{$lang->doc->browseTypeList['grid']}' class='btn btn-icon'");?>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <table class="table table-borderless table-hover table-files table-fixed no-margin">
        <thead>
          <tr>
            <?php $name = '';?>
            <?php $name = $lang->doclib->nameList[$type];?>
            <th class="c-name"><?php echo $name;?></th>
            <th class="w-120px"><?php echo $lang->actions;?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($libs as $lib):?>
          <?php $link = ($type == 'product' or $type == 'project') ? $this->createLink('doc', 'objectLibs', "type=$type&objectID=$lib->id") : $this->createLink('doc', 'browse', "libID=$lib->id");?>
          <tr>
            <td class="c-name"><?php echo html::a($link, $lib->name);?></td>
            <td class="c-actions">
              <?php $star = strpos($lib->collector, ',' . $this->app->user->account . ',') !== false ? 'icon-star text-yellow' : 'icon-star-empty';?>
              <?php $collectTitle = strpos($lib->collector, ',' . $this->app->user->account . ',') !== false ? $lang->doc->cancelCollection : $lang->doc->collect;?>
              <a data-url="<?php echo $this->createLink('doc', 'collect', "objectID=$lib->id&objectType=doclib");?>" title="<?php echo $collectTitle;?>" class='btn btn-link ajaxCollect'><i class='icon <?php echo $star;?>'></i></a>
              <?php common::printLink('doc', 'editLib', "libID=$lib->id", "<i class='icon icon-edit'></i>", '', "title='{$lang->edit}' class='btn btn-link iframe'")?>
              <?php common::printLink('doc', 'deleteLib', "libID=$lib->id", "<i class='icon icon-close'></i>", 'hiddenwin', "title='{$lang->delete}' class='btn btn-link'")?>
              <?php common::printLink('doc', 'manageBook', "bookID=$lib->id&nodeID=0", "<i class='icon icon-cog'></i>", '', "title='{$lang->doc->manageBook}' class='btn btn-link'")?>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      <div class='table-footer'><?php $pager->show('right', 'pagerjs');?></div>
    </div>
  </div>
</div>
