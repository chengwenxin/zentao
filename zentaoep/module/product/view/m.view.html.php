<?php
/**
 * The view mobile view file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $product->id;?></strong></span>
      <strong><?php echo $product->name;?></strong>
    </div>
  </div>
  <div class='section no-margin'>
    <div class="outline">
      <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
        <a class='active' data-target="#desc"><?php echo $lang->product->desc?></a>
        <a data-target="#basicInfo"><?php echo $lang->product->basicInfo?></a>
        <a data-target="#otherInfo"><?php echo $lang->product->otherInfo?></a>
      </nav>
      <div>
        <div class="display in" id="desc">
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->product->desc?></strong></div>
          </div>
          <div class='article'><?php echo $product->desc?></div>
          <?php include '../../common/view/m.action.html.php';?>
        </div>
        <div class="display hidden?>" id="basicInfo">
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-100px'><?php echo $lang->product->name;?></th>
              <td <?php if($product->deleted) echo "class='deleted text-danger'";?>><strong><?php echo $product->name;?></strong></td>
            </tr>  
            <tr>
              <th><?php echo $lang->product->code;?></th>
              <td><?php echo $product->code;?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->product->PO;?></th>
              <td><?php echo zget($users, $product->PO);?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->product->QD;?></th>
              <td><?php echo zget($users, $product->QD);?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->product->RD;?></th>
              <td><?php echo zget($users, $product->RD);?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->product->type;?></th>
              <td><?php echo $lang->product->typeList[$product->type];?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->product->status;?></th>
              <td class='product-<?php echo $product->status?>'><?php echo $lang->product->statusList[$product->status];?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->story->openedBy?></th>
              <td><?php echo zget($users, $product->createdBy);?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->openedDate?></th>
              <td><?php echo $product->createdDate;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->product->acl;?></th>
              <td><?php echo $lang->product->aclList[$product->acl];?></td>
            </tr>  
            <?php if($product->acl == 'custom'):?>
            <tr>
              <th><?php echo $lang->product->whitelist;?></th>
              <td>
                <?php
                $whitelist = explode(',', $product->whitelist);
                foreach($whitelist as $groupID) if(isset($groups[$groupID])) echo $groups[$groupID] . '&nbsp;';
                ?>
              </td>
            </tr>
            <?php endif;?>
          </table>
        </div>
        <div class="display hidden" id="otherInfo">
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-100px'><?php echo $lang->story->statusList['active']  . $lang->story->common;?></th>
              <td class='strong'><?php echo $product->stories['active']?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->statusList['changed']  . $lang->story->common;?></th>
              <td><?php echo $product->stories['changed']?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->statusList['draft']  . $lang->story->common;?></th>
              <td><?php echo $product->stories['draft']?></td>
            </tr>
            <tr>
              <th><?php echo $lang->story->statusList['closed']  . $lang->story->common;?></th>
              <td><?php echo $product->stories['closed']?></td>
            </tr>
            <tr>
              <th><?php echo $lang->product->plans?></th>
              <td><?php echo $product->plans?></td>
            </tr>
            <tr>
              <th><?php echo $lang->product->projects?></th>
              <td><?php echo $product->projects?></td>
            </tr>
            <tr>
              <th><?php echo $lang->product->bugs?></th>
              <td><?php echo $product->bugs?></td>
            </tr>
            <tr>
              <th><?php echo $lang->product->docs?></th>
              <td><?php echo $product->docs?></td>
            </tr>
            <tr>
              <th><?php echo $lang->product->cases?></th>
              <td><?php echo $product->cases?></td>
            </tr>
            <tr>
              <th><?php echo $lang->product->builds?></th>
              <td><?php echo $product->builds?></td>
            </tr>
            <tr>
              <th><?php echo $lang->product->releases?></th>
              <td><?php echo $product->releases?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/m.footer.html.php';?>
