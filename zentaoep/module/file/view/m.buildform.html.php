<?php
/**
 * The buildform mobile view file of file module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     file 
 * @version     $Id: buildform.html.php 3760 2016-04-15 05:20:21Z daitingting $
 * @link        http://www.ranzhico.com
 */
?>
<?php
$filesUID = 'files-' . uniqid();
$maxSize  = ini_get('upload_max_filesize');
?>
<div id='<?php echo $filesUID ?>' class='list gray compact'>
  <div class='heading'>
    <div class='title'><?php echo $this->lang->file->common ?> <?php echo '(' . $maxSize . ')';?></div>
  </div>
  <div class="item file"><div class="content"><input type="file" name="files[]" class="fluid"></div><a class="btn file-deleter"><i class="icon-trash text-danger"></i></a></div>
  <div class='divider'></div>
  <div class='item'>
    <a class='btn text-primary file-add'><i class="icon-plus"></i></a>
  </div>
</div>
<script>
$(function()
{
    var $files = $('#<?php echo $filesUID ?>');
    var $template = $('<div class="item file"><div class="content"><input type="file" name="files[]" class="fluid"></div><a class="btn file-deleter"><i class="icon-trash text-danger"></i></a></div>');
    var $divider = $files.children('.divider');
    var appendFile = function(count)
    {
        count = count || 1;
        for(var i = count; i > 0; i--) $divider.before($template.clone());
    };

    appendFile("<?php echo $fileCount ?>");

    $files.on($.TapName, '.file-add', function() {appendFile();})
          .on($.TapName, '.file-deleter', function() {$(this).closest('.file').remove();})
          .on('change', 'input[type="file"]', function()
          {
              var $file = $(this);
              $file.closest('.item').removeClass('danger-pale');
              if(typeof($file[0].files) != 'undefined')
              {
                  var maxUploadInfo = "<?php echo $maxSize;?>";
                  var sizeType = {'K': 1024, 'M': 1024 * 1024, 'G': 1024 * 1024 * 1024};
                  var unit = maxUploadInfo.replace(/\d+/, '');
                  var maxUploadSize = maxUploadInfo.replace(unit, '') * sizeType[unit];
                  var fileSize = 0;
                  $files.find('input[type="file"]').each(function()
                  {
                      if($(this).val()) fileSize += $(this)[0].files[0].size;
                  });
                  if($file[0].files[0].size > maxUploadSize)
                  {
                      alert('<?php echo $lang->file->errorFileSize?>');
                      $file.closest('.item').addClass('danger-pale');
                  }
                  else if(fileSize > maxUploadSize)
                  {
                      alert('<?php echo $lang->file->errorFileSize?>');
                  }
              }
          });
});
</script>
