<?php
/**
 * The export view file of file module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Congzhi Chen <congzhi@cnezsoft.com>
 * @package     file
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php $this->app->loadLang('file');?>
<style>
#customFields .panel {border: 1px solid #ddd; background: #fafafa; margin: 0;}
#customFields .panel-actions {padding: 0;}
#customFields .panel {position: relative;}
#customFields .panel:before, #customFields .panel:after {content: ' '; display: block; width: 0; height: 0; border-style: solid; border-width: 0 10px 10px 10px; border-color: transparent transparent #f1f1f1 transparent; position: absolute; left: 315px; top: -9px;}
#customFields .panel:before {border-color: transparent transparent #ddd transparent; top: -10px;}
</style>
<script>
function setDownloading()
{
    if($.browser.opera) return true;   // Opera don't support, omit it.

    var $fileName = $('#fileName');
    if($fileName.val() === '') $fileName.val('<?php echo $lang->file->untitled;?>');

    $.cookie('downloading', 0);
    time = setInterval("closeWindow()", 300);
    $('#mainContent').addClass('loading');
    return true;
}

function closeWindow()
{
    if($.cookie('downloading') == 1)
    {
        $('#mainContent').removeClass('loading');
        parent.$.closeModal();
        $.cookie('downloading', null);
        clearInterval(time);
    }
}
function switchEncode(fileType)
{
    var $encode = $('#encode');
    if(fileType != 'csv') $encode.val('utf-8').attr('disabled', 'disabled');
    else $encode.removeAttr('disabled');
    $encode.trigger('chosen:updated');
}

function saveTemplate()
{
    var $inputGroup = $('#customFields div.input-group');
    var $publicBox  = $inputGroup.find('input[id^="public"]');
    var title       = $inputGroup.find('#title').val();
    var content     = $('#customFields #exportFields').val();
    var isPublic    = ($publicBox.size() > 0 && $publicBox.prop('checked')) ? $publicBox.val() : 0;
    if(!title || !content) return;
    saveTemplateLink = '<?php echo $this->createLink('file', 'ajaxSaveTemplate', 'module=' . $this->moduleName);?>';
    $.post(saveTemplateLink, {title:title, content:content, public:isPublic}, function(data)
    {
        var defaultValue = $('#tplBox #template').val();
        $('#tplBox').html(data);
        if(data.indexOf('alert') >= 0) $('#tplBox #template').val(defaultValue);
        $("#tplBox #template").chosen().on('chosen:showing_dropdown', function()
        {
            var $this = $(this);
            var $chosen = $this.next('.chosen-container').removeClass('chosen-up');
            var $drop = $chosen.find('.chosen-drop');
            $chosen.toggleClass('chosen-up', $drop.height() + $drop.offset().top - $(document).scrollTop() > $(window).height());
        });
        $inputGroup.find('#title').val(title);
    });
}

/* Set template. */
function setTemplate(templateID)
{
    var $template=  $('#tplBox #template' + templateID);
    var exportFields = $template.size() > 0 ? $template.html() : defaultExportFields;
    exportFields = exportFields.split(',');
    $('#exportFields').val('');
    for(i in exportFields) $('#exportFields').find('option[value="' + exportFields[i] + '"]').attr('selected', 'selected');
    $('#exportFields').trigger("chosen:updated");
}

/* Delete template. */
function deleteTemplate()
{
    var templateID = $('#tplBox #template').val();
    if(templateID == 0) return;
    hiddenwin.location.href = createLink('file', 'ajaxDeleteTemplate', 'templateID=' + templateID);
    $('#tplBox #template').find('option[value="'+ templateID +'"]').remove();
    $('#tplBox #template').trigger("chosen:updated");
    $('#tplBox #template').change();
}

/**
 * Toggle export template box.
 * 
 * @access public
 * @return void
 */
function setExportTPL()
{
    $('#customFields').toggleClass('hidden');
}

$(document).ready(function()
{
    $(document).on('change', '#template', function()
    {
        $('#title').val($(this).find('option:selected').text());
    });

    $('#fileType').change();
    <?php if($this->cookie->checkedItem):?>
    setTimeout(function()
    {
        $('#exportType').val('selected').trigger('chosen:updated');
    }, 150);
    <?php endif;?>
});
</script>
<?php
$isCustomExport = (!empty($customExport) and !empty($allExportFields));
if($isCustomExport)
{
    $allExportFields  = explode(',', $allExportFields);
    $hasDefaultField  = isset($selectedFields);
    $selectedFields   = $hasDefaultField ? explode(',', $selectedFields) : array();
    $exportFieldPairs = array();
    $moduleName = $this->moduleName;
    $moduleLang = $lang->$moduleName;
    foreach($allExportFields as $key => $field)
    {
        $field                    = trim($field);
        $exportFieldPairs[$field] = isset($moduleLang->$field) ? $moduleLang->$field : (isset($lang->$field) ? $lang->$field : $field);
        if(!$hasDefaultField)$selectedFields[] = $field;
    }
    js::set('defaultExportFields', join(',', $selectedFields));
} 
?>
<main id="main">
  <div class="container">
    <div id="mainContent" class='main-content load-indicator'>
      <div class='main-header'>
        <h2><?php echo $lang->export;?></h2>
      </div>
      <form class='main-form' method='post' target='hiddenwin'>
        <table class="table table-form">
          <tbody>
            <tr>
              <th><?php echo $lang->file->fileName;?></th>
              <td class="w-300px"><?php echo html::input('fileName', isset($fileName) ? $fileName : '', "class='form-control' autofocus autocomplete='off' placeholder='{$lang->file->untitled}'");?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->file->extension;?></th>
              <td><?php echo html::select('fileType', $lang->exportFileTypeList, '', 'onchange=switchEncode(this.value) class="form-control"');?></td>
            </tr>
            <tr>
              <th><?php echo $lang->file->encoding;?></th>
              <td><?php echo html::select('encode', $config->charsets[$this->cookie->lang], 'utf-8', key($lang->exportFileTypeList) == 'csv' ? "class='form-control'" : "class='form-control'");?></td>
            </tr>
            <?php $hide = isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'kanban') !== false ? 'style="display:none"' : '';?>
            <tr <?php echo $hide;?>>
              <th><?php echo $lang->file->exportRange;?></th>
              <td>
                <?php if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'calendar') !== false) unset($lang->exportTypeList['selected']);?>
                <?php echo html::select('exportType', $lang->exportTypeList, 'all', "class='form-control'");?>
              </td>
            </tr>
            <?php if($isCustomExport):?>
            <tr>
              <th><?php echo $lang->file->tplTitle;?></th>
              <td id="tplBox"><?php echo $this->fetch('file', 'buildExportTPL', 'module=' . $this->moduleName);?></td>
              <td>
                <button type='button' onclick='setExportTPL()' class='btn'><?php echo $lang->file->setExportTPL?></button>
              </td>
            </tr>
            <tr id='customFields' class="hidden">
              <th></th>
              <td colspan="2">
                <div class='panel'>
                  <div class='panel-heading'>
                    <strong><?php echo $lang->file->exportFields?></strong>
                    <div class="panel-actions btn-toolbar">
                      <button type="button" class="btn btn-link" onclick="setExportTPL()"><i class="icon icon-close icon-sm muted"></i></button>
                    </div>
                  </div>
                  <div class='panel-body'>
                    <p><?php echo html::select('exportFields[]', $exportFieldPairs, $selectedFields, "class='form-control chosen' multiple")?></p>
                    <div>
                      <div class='input-group'>
                        <span class='input-group-addon'><?php echo $lang->file->tplTitle;?></span>
                        <?php echo html::input('title', $lang->file->defaultTPL, "class='form-control' autocomplete='off'")?>
                        <?php if(common::hasPriv('file', 'setPublic')):?>
                        <span class='input-group-addon'><?php echo html::checkbox('public', array(1 => $lang->public));?></span>
                        <?php endif?>
                        <span class='input-group-btn'><button id='saveTpl' type='button' onclick='saveTemplate()' class='btn btn-primary'><?php echo $lang->save?></button></span>
                        <span class='input-group-btn'><button type='button' onclick='deleteTemplate()' class='btn'><?php echo $lang->delete?></button></span>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php endif?>
            <tr>
              <th></th>
              <td>
                <?php echo html::submitButton($lang->export, "onclick='setDownloading();'", 'btn btn-primary');?>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>
</main>
<?php include '../../common/view/footer.lite.html.php';?>
