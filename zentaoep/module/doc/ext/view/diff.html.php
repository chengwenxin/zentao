<?php
/**
 * The view of doc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Jia Fu <fujia@cnezsoft.com>
 * @package     doc
 * @version     $Id: view.html.php 975 2010-07-29 03:30:25Z jajacn@126.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<style>
.htmldiff {white-space:pre-wrap;}
.htmldiff del {color: red; background: #fdd; text-decoration: none; border-left:2px solid #fdd; border-right:2px solid #fdd;}
.htmldiff del img{border:2px solid red;}
.htmldiff ins {color: green; background: #dfd; text-decoration: none; border-left:2px solid #dfd; border-right:2px solid #dfd;}
.htmldiff ins img{border:2px solid green;}
</style>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'>
    <?php echo html::a(inlink('view', "docID=$newDoc->id"), "<i class='icon icon-back'></i> " . $lang->goback, '', "class='btn btn-link'");?>
    <div class='divider'></div>
    <div class='page-title'>
      <span class='label label-id' title='DOC'><?php echo $docID;?></span>
      <strong><?php echo $newDoc->title;?></strong>
      <?php echo $lang->arrow;?>
      <small class='dropdown versions'>
        <a href='#' data-toggle='dropdown' class='text-muted'><?php echo '#' . $oldVersion;?> <span class='caret'></span></a>
          <ul class='dropdown-menu'>
          <?php
          for($i =$newDoc->version; $i > 0; $i--)
          {
              if($i == $newVersion) continue;
              $class = $i == $oldVersion ? " class='active'" : '';
              echo '<li' . $class .'>' . html::a(inlink('diff', "docID=$newDoc->id&newVersion=$newVersion&oldVersion=$i"), '#' . $i) . '</li>';
          }
          ?>
        </ul>
      </small>
      <?php echo $lang->colon;?>
      <small class='dropdown versions'>
        <a href='#' data-toggle='dropdown' class='text-muted'><?php echo '#' . $newVersion;?> <span class='caret'></span></a>
          <ul class='dropdown-menu'>
          <?php
          for($i =$newDoc->version; $i > 0; $i--)
          {
              if($i == $oldVersion) continue;
              $class = $i == $newVersion ? " class='active'" : '';
              echo '<li' . $class .'>' . html::a(inlink('diff', "docID=$newDoc->id&newVersion=$i&oldVersion=$oldVersion"), '#' . $i) . '</li>';
          }
          ?>
        </ul>
      </small>
      <?php if($newDoc->deleted):?>
      <span class='label label-danger'><?php echo $lang->doc->deleted;?></span>
      <?php endif; ?>
    </div>
  </div>
</div>
<div id='mainContent' class='main-content'>
  <table class='table table-data alldiff'>
    <?php foreach($diff as $field => $renderedDiff):?>
    <?php
    $oldIsImage = $this->doc->isImage($oldDoc->$field);
    $newIsImage = $this->doc->isImage($newDoc->$field);
    ?>
    <?php if($oldIsImage and $newIsImage):?>
    <?php if($renderedDiff == 'same') continue;?>
    <tr>
      <th class='w-80px'><?php echo $lang->doc->$field?></th>
      <?php if($renderedDiff === false):?>
      <td>
      <img onload="setImageSize(this,0)" src="<?php echo $oldIsImage?>" />
      </td>
      <td>
      <img onload="setImageSize(this,0)" src="<?php echo $newIsImage?>" />
      </td>
      <?php else:?>
      <td colspan='2'>
      <img onload="setImageSize(this,0)" src="data:image/png;base64,<?php echo base64_encode(file_get_contents($renderedDiff))?>" />
      </td>
      <?php endif;?>
    </tr>
    <?php else:?>
    <?php if(empty($renderedDiff)) continue;?>
    <?php if(strpos($renderedDiff, '<ins>') === false and strpos($renderedDiff, '<del>') === false) continue;?>
    <tr>
      <th class='w-80px'><?php echo $lang->doc->$field?></th>
      <td colspan='2'>
        <div class="htmldiff"><?php echo $renderedDiff?></div>
      </td>
    </tr>
    <?php endif;?>
    <?php endforeach;?>
  </table>
</div>
<?php include '../../../common/view/footer.html.php';?>
