<?php
/**
 * The browse view file of tree module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     tree
 * @version     $Id: browse.html.php 4796 2013-06-06 02:21:59Z zhujinyonging@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<div id="mainMenu" class="clearfix">
  <div class='page-title'><span class='text'><?php echo $lang->tree->groupMaintenance;?></span></div>
</div>
<div id='mainContent' class='main-row'>
  <div class='side-col col-4'>
    <div class='panel'>
      <div class='panel-heading'><i class='icon-cog'></i> <strong><?php echo $lang->tree->groupMaintenance;?></strong></div>
      <div class='panel-body'>
        <ul class='tree-lines' id='modulesTree'></ul>
      </div>
    </div>
  </div>

  <div class='main-col col-8'>
    <div class='panel'>
      <div class='panel-heading'>
        <i class='icon-sitemap'></i> 
        <?php echo $lang->tree->manageHostChild;?>
      </div>
      <div class='panel-body'>
        <form id='childrenForm' method='post' target='hiddenwin' action='<?php echo $this->createLink('tree', 'manageChild', "root=0&viewType=host");?>'>
          <table class='table table-form table-auto'>
            <tr>
              <td class="text-middle text-right with-padding">
                <?php
                echo '<span>' . html::a($this->createLink('tree', 'browseHost', "moduleID=0"), $lang->tree->host) . '</span>';
                foreach($parents as $parent)
                {
                    echo '<span>' . html::a($this->createLink('tree', 'browseHost', "moduleID=$parent->id"), $parent->name) . '</span>';
                }
                ?>  
              </td>
              <td id='moduleBox'> 
                <?php $maxOrder = 0;?>
                <div id="sonModule">
                  <?php foreach($sons as $sonModule):?>
                  <?php if($sonModule->order > $maxOrder) $maxOrder = $sonModule->order;?>
                  <div class="table-row row-module">
                    <div class='table-col col-module'><?php echo html::input("modules[id$sonModule->id]", $sonModule->name, "class='form-control' autocomplete='off' placeholder='{$lang->tree->groupName}' ");?></div>
                    <div class='table-col col-shorts'><?php echo html::input("shorts[id$sonModule->id]", $sonModule->short,"class='form-control' autocomplete='off' placeholder='{$lang->tree->short}' ") . html::hidden("order[id$sonModule->id]", $sonModule->order);?></div>
                    <div class='table-col col-actions'>
                      <button type="button" class="btn btn-link btn-icon btn-add" onclick="addItem(this)"><i class="icon icon-plus"></i></button>
                    </div>
                  </div>
                  <?php endforeach;?>
                  <?php for($i = 0; $i < TREE::NEW_CHILD_COUNT ; $i ++):?>
                  <div class="table-row row-module row-module-new">
                    <div class='table-col col-module'><?php echo html::input("modules[]", '', "class='form-control' autocomplete='off' placeholder='{$lang->tree->groupName}'");?></div>
                    <div class='table-col col-shorts'><?php echo html::input("shorts[]", '', "class='form-control' autocomplete='off' placeholder='{$lang->tree->short}'");?></div>
                    <div class="table-col col-actions">
                      <button type="button" class="btn btn-link btn-icon btn-add" onclick="addItem(this)"><i class="icon icon-plus"></i></button>
                      <button type="button" class="btn btn-link btn-icon btn-delete" onclick="deleteItem(this)"><i class="icon icon-trash"></i></button>
                    </div>
                  </div>
                  <?php endfor;?>
                </div>
  
                <div id="insertItemBox" class="template">
                  <div class="table-row row-module row-module-new">
                    <div class="table-col col-module"><?php echo html::input("modules[]", '', "class='form-control' placeholder='{$name}' autocomplete='off'");?></div>
                    <?php if($hasBranch):?>
                    <div class="table-col col-module"><?php echo html::select("branch[]", $branches, $branch, 'class="form-control"');?></div>
                    <?php endif;?>
                    <div class="table-col col-shorts"><?php echo html::input("shorts[]", '', "class='form-control' placeholder='{$lang->tree->short}' autocomplete='off'");?></div>
                    <div class="table-col col-actions">
                      <button type="button" class="btn btn-link btn-icon btn-add" onclick="addItem(this)"><i class="icon icon-plus"></i></button>
                      <button type="button" class="btn btn-link btn-icon btn-delete" onclick="deleteItem(this)"><i class="icon icon-trash"></i></button>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td></td>
              <td colspan='2' class='form-actions'>
                <?php
                echo html::submitButton();
                echo $this->session->hostList ? html::linkButton($this->lang->goback, $this->session->hostList) : html::backButton('', '', 'btn');
                echo html::hidden('parentModuleID', $moduleID);
                echo html::hidden('maxOrder', $maxOrder);
                ?>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(function()
{
    var data = $.parseJSON('<?php echo helper::jsonEncode4Parse($tree);?>');
    var options = {
        name: 'tree-editHost-edit',
        initialState: 'preserve',
        data: data,
        itemCreator: function($li, item)
        {
            var $toggle = $('<span class="module-name" data-id="' + item.id + '">' + link + '</span>');

            var title = (item.type === 'product' ? '<i class="icon icon-cube text-muted"></i> ' : '') + item.name;
            var link = item.id !== undefined ? ('<a href="' + createLink('tree', 'browseHost', 'moduleID=' + item.id) + '">' + title + '</a>') : ('<span class="tree-toggle">' + title + '</span>');
            var $toggle = $('<span class="module-name" data-id="' + item.id + '">' + link + '</span>');
            $li.append($toggle);
            if(item.nodeType) $li.addClass('tree-item-' + item.nodeType);
            return true;
        },
        actions: 
        {
            sort:
            {
                title: '<?php echo $lang->tree->dragAndSort ?>',
                template: '<a class="sort-handler" href="javascript:;"><?php echo $lang->tree->sort ?></a>'
            },
            edit:
            {
                linkTemplate: '<?php echo helper::createLink('tree', 'editHost', "moduleID={0}"); ?>',
                title: '<?php echo $lang->tree->edit ?>',
                template: '<a href="javascript:;"><?php echo $lang->edit?></a>'
            },
            "delete":
            {
                linkTemplate: '<?php echo helper::createLink('tree', 'delete', "rootID=0&moduleID={0}"); ?>',
                title: '<?php echo $lang->tree->delete ?>',
                template: '<a href="javascript:;"><?php echo $lang->delete?></a>'
            },
            subModules:
            {
                linkTemplate: '<?php echo helper::createLink('tree', 'browseHost', "moduleID={0}"); ?>',
                title: '<?php echo $lang->tree->childGroup ?>',
                template: '<a href="javascript:;"><?php echo $lang->tree->childGroup?></a>'
            }
        },
        action: function(event)
        {
            var action = event.action, $target = $(event.target), item = event.item;
            if(action.type === 'edit')
            {
                new $.zui.ModalTrigger(
                {
                    type: 'ajax',
                    url: action.linkTemplate.format(item.id),
                    keyboard: true
                }).show();
            }
            else if(action.type === 'delete')
            {
                window.open(action.linkTemplate.format(item.id), 'hiddenwin');
            }
            else if(action.type === 'add')
            {
                window.location.href = action.linkTemplate.format(item.id);
            }
            else if(action.type === 'sort')
            {
                var orders = {};
                $('#modulesTree').find('li:not(.tree-action-item)').each(function()
                {
                    var $li = $(this);
                    var item = $li.data();
                    orders['orders[' + item.id + ']'] = $li.attr('data-order') || item.order;
                });
                $.post('<?php echo $this->createLink('tree', 'updateOrder');?>', orders).error(function()
                {
                    bootbox.alert(lang.timeout);
                });
            }
            else if(action.type === 'subModules')
            {
                window.location.href = action.linkTemplate.format(item.id, item.branch);
            }
        }
    };

    if(<?php echo common::hasPriv('tree', 'updateorder') ? 'false' : 'true' ?>) options.actions["sort"] = false;
    if(<?php echo common::hasPriv('tree', 'editHost') ? 'false' : 'true' ?>) options.actions["editHost"] = false;
    if(<?php echo common::hasPriv('tree', 'delete') ? 'false' : 'true' ?>) options.actions["delete"] = false;

    var $tree = $('#modulesTree').tree(options);

    var tree = $tree.data('zui.tree');
    if(!tree.store.time) tree.expand($tree.find('li:not(.tree-action-item)').first());
    if(<?php echo $moduleID ?>)
    {
        var $currentLi = $tree.find('.module-name[data-id=' + <?php echo $moduleID ?> + ']').closest('li');
        if($currentLi.length) tree.show($currentLi);
    }

    $tree.on('mouseenter', 'li:not(.tree-action-item)', function(e)
    {
        $('#modulesTree').find('li.hover').removeClass('hover');
        $(this).addClass('hover');
        e.stopPropagation();
    });

    $tree.find('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php include '../../../common/view/footer.html.php';?>
